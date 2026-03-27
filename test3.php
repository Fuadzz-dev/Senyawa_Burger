<?php
$a = json_decode(file_get_contents('duitku_res.json'));
if($a === null) {
    // maybe utf-16?
    $cont = file_get_contents('duitku_res.json');
    $cont = mb_convert_encoding($cont, 'UTF-8', 'UTF-16LE');
    $a = json_decode($cont, true);
} else {
    $a = json_decode(file_get_contents('duitku_res.json'), true);
}
echo "LEN: " . strlen($a['qrString']) . "\n";
echo "QR: " . substr($a['qrString'], 0, 50) . "...\n";
