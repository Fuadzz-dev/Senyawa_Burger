<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Pesanan;
use App\Models\DetailPesanan;

class PaymentController extends Controller
{
    private $merchantCode;
    private $apiKey;
    private $env;

    public function __construct()
    {
        $this->merchantCode = env('DUITKU_MERCHANT_CODE');
        $this->apiKey = env('DUITKU_API_KEY');
        $this->env = env('DUITKU_ENV', 'sandbox');
    }

    public function processCheckout(Request $request)
    {
        $method = $request->input('paymentMethod'); // 'online' or 'kasir'
        $cart = $request->input('cart', []);
        $nama = $request->input('nama');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $orderType = $request->input('orderType', 'dine_in');
        $amount = $request->input('amount');

        // Convert the order type phrase into DB enum if needed
        $tipeOrderDb = 'dine_in';
        if (str_contains(strtolower($orderType), 'bawa pulang') || str_contains(strtolower($orderType), 'take')) {
            $tipeOrderDb = 'take_away';
        }

        if (empty($cart) || !$amount || !$nama || !$phone) {
            return response()->json(['success' => false, 'message' => 'Data pesanan tidak lengkap'], 400);
        }

        // Create Pesanan
        $pesanan = new Pesanan();
        $pesanan->nama = $nama;
        $pesanan->no_telepon = $phone;
        $pesanan->email = $email;
        $pesanan->total_harga = $amount;
        $pesanan->tipe_order = $tipeOrderDb;
        $pesanan->status_pembayaran = 'Belum Lunas';
        $pesanan->save();

        // Create Detail
        foreach ($cart as $item) {
            $detail = new DetailPesanan();
            $detail->id_pesanan = $pesanan->id_pesanan;
            $detail->id_menu = $item['id'];
            $detail->jumlah = $item['qty'];
            $detail->harga_satuan = $item['price'] / $item['qty'];
            $detail->kustomisasi = $item['note'] ?? null; 
            $detail->save();
        }

        if ($method === 'kasir') {
            session(['menunggu_kasir_id' => $pesanan->id_pesanan]);
            return response()->json([
                'success' => true, 
                'message' => 'Pesanan berhasil disimpan', 
                'method' => 'kasir',
                'id_pesanan' => $pesanan->id_pesanan
            ]);
        }

        // --- Duitku Online QRIS ---
        $merchantOrderId = 'TRX-' . $pesanan->id_pesanan . '-' . time();
        $productDetails = 'Pembayaran Pesanan #' . $pesanan->id_pesanan;
        $paymentMethod = 'SP'; // ShopeePay for QRIS
        $returnUrl = url('/keranjang');
        $callbackUrl = url('/api/duitku/callback');

        $signature = md5($this->merchantCode . $merchantOrderId . $amount . $this->apiKey);

        $params = array(
            'merchantcode' => $this->merchantCode,
            'merchantOrderId' => $merchantOrderId,
            'paymentAmount' => $amount,
            'paymentMethod' => $paymentMethod,
            'productDetails' => $productDetails,
            'email' => $email ?: 'customer@example.com',
            'customerVaName' => $nama,
            'callbackUrl' => $callbackUrl,
            'returnUrl' => $returnUrl,
            'signature' => $signature,
            'expiryPeriod' => 15 // minutes
        );

        $url = "https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry";
        $response = Http::post($url, $params);

        if ($response->successful() && isset($response['qrString'])) {
            // Save reference to Pesanan to link later
            $pesanan->payment_reference = $response['reference'];
            $pesanan->save();

            return response()->json([
                'success' => true,
                'qrString' => $response['qrString'],
                'reference' => $response['reference']
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal memanggil API Duitku',
            'api_response' => $response->json()
        ], 400);
    }

    public function checkStatus($reference)
    {
        $signature = md5($this->merchantCode . $reference . $this->apiKey);

        $params = [
            'merchantCode' => $this->merchantCode,
            'reference' => $reference,
            'signature' => $signature
        ];

        $url = "https://sandbox.duitku.com/webapi/api/merchant/transactionStatus";
        $response = Http::post($url, $params);

        if ($response->successful()) {
            $statusCode = $response['statusCode'];
            if ($statusCode === "00") {
                // Payment success, update Pesanan!
                $pesanan = Pesanan::where('payment_reference', $reference)->first();
                if ($pesanan) {
                    $pesanan->status_pembayaran = 'Lunas';
                    $pesanan->save();
                }
            }

            return response()->json([
                'success' => true,
                'statusCode' => $statusCode,
                'statusMessage' => $response['statusMessage']
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to check status'
        ], 400);
    }

    public function menungguKasir()
    {
        $id = session('menunggu_kasir_id');
        if (!$id) {
            return redirect('/');
        }
        $pesanan = Pesanan::with('detailPesanan.menu')->find($id);
        if (!$pesanan) {
            return redirect('/');
        }
        return view('MenungguKasir', compact('pesanan'));
    }

    public function checkLocalStatus($id)
    {
        $pesanan = Pesanan::find($id);
        if ($pesanan) {
            return response()->json([
                'success' => true,
                'status_pembayaran' => $pesanan->status_pembayaran
            ]);
        }
        return response()->json(['success' => false], 404);
    }
}
