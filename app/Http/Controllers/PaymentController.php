<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function createQris(Request $request)
    {
        $amount = $request->input('amount');
        if (!$amount) {
            return response()->json(['success' => false, 'message' => 'Amount is required'], 400);
        }

        $merchantOrderId = 'TRX-' . time() . '-' . rand(100, 999);
        $productDetails = 'Pembayaran Pesanan';
        $email = 'customer@example.com';
        $paymentMethod = 'SP'; // ShopeePay for QRIS
        $returnUrl = url('/keranjang');
        $callbackUrl = url('/api/duitku/callback');

        $timestamp = round(microtime(true) * 1000); // in milliseconds
        $signature = md5($this->merchantCode . $merchantOrderId . $amount . $this->apiKey);

        $params = array(
            'merchantcode' => $this->merchantCode,
            'merchantOrderId' => $merchantOrderId,
            'paymentAmount' => $amount,
            'paymentMethod' => $paymentMethod,
            'productDetails' => $productDetails,
            'email' => $email,
            'customerVaName' => 'Pembeli',
            'callbackUrl' => $callbackUrl,
            'returnUrl' => $returnUrl,
            'signature' => $signature,
            'expiryPeriod' => 15
        );

        // Usually Duitku Sandbox URL
        $url = "https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry";

        $response = Http::post($url, $params);

        if ($response->successful() && isset($response['qrString'])) {
            return response()->json([
                'success' => true,
                'qrString' => $response['qrString'],
                'reference' => $response['reference']
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to create QRIS from Duitku',
            'api_response' => $response->json()
        ], 400);
    }

    public function checkStatus($reference)
    {
        // Parameter check transaction: merchantcode, reference, signature(md5: merchantCode + reference + apiKey)
        $signature = md5($this->merchantCode . $reference . $this->apiKey);

        $params = [
            'merchantCode' => $this->merchantCode,
            'reference' => $reference,
            'signature' => $signature
        ];

        $url = "https://sandbox.duitku.com/webapi/api/merchant/transactionStatus";

        $response = Http::post($url, $params);

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'statusCode' => $response['statusCode'], // "00" is success
                'statusMessage' => $response['statusMessage']
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to check status'
        ], 400);
    }
}
