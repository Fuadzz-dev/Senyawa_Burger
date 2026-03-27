<?php
$merchantCode = 'DS29145';
$apiKey = '7c984a41d29d32166e719dc5bae0097b';
$amount = 13525;
$merchantOrderId = 'TRX-' . time() . '-' . rand(100, 999);
$productDetails = 'Pembayaran Pesanan';
$email = 'customer@example.com';
$paymentMethod = 'SP'; // ShopeePay for QRIS
$returnUrl = 'http://127.0.0.1:8000/keranjang';
$callbackUrl = 'http://127.0.0.1:8000/api/duitku/callback';

$signature = md5($merchantCode . $merchantOrderId . $amount . $apiKey);

$params = array(
    'merchantcode' => $merchantCode,
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

$url = "https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Content-Length: ' . strlen(json_encode($params))]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
$result = curl_exec($ch);
curl_close($ch);

echo "RESPONSE: " . $result;
