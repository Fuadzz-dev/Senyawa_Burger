<?php
$merchantCode = 'DS29145'; // user provided
$apiKey = '7c984a41d29d32166e719dc5bae0097b'; // user provided
$amount = 10000;
$datetime = date('Y-m-d H:i:s');
$signature = hash('sha256', $merchantCode . $amount . $datetime . $apiKey);

$params = [
    'merchantcode' => $merchantCode,
    'amount' => $amount,
    'datetime' => $datetime,
    'signature' => $signature
];

$url = 'https://sandbox.duitku.com/webapi/api/merchant/paymentmethod/getpaymentmethod';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
$result = curl_exec($ch);
curl_close($ch);

echo $result;
