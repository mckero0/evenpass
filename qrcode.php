<?php
require 'phpqrcode/qrlib.php'; // inclure phpqrcode directement dans ton projet
$token = $_GET['token'] ?? '';

// URL vers verify.php sur Render
$domain = getenv('RENDER_EXTERNAL_URL') ?: 'http://localhost';
$url = "$domain/verify.php?token=$token";

header('Content-Type: image/png');
QRcode::png($url, false, QR_ECLEVEL_H, 5);
?>
