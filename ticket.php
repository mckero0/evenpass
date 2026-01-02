<?php
require 'db.php';
$token = $_GET['token'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM billets WHERE qr_token=?");
$stmt->execute([$token]);
$billet = $stmt->fetch();
if (!$billet) die("Billet introuvable !");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Billet EvenPass</title>
<style>
body { font-family:'Segoe UI',sans-serif; background:linear-gradient(135deg,#74ebd5,#ACB6E5); display:flex; justify-content:center; align-items:center; height:100vh; }
.ticket { background:#fff; border-radius:20px; padding:30px 40px; box-shadow:0 10px 25px rgba(0,0,0,0.2); text-align:center; max-width:400px; width:100%; position:relative; }
.ticket:hover { transform: translateY(-5px); transition:0.3s; }
h2 { color:#333; margin-bottom:15px; }
p { color:#555; margin:5px 0; font-size:1rem; }
.qr-code { margin:20px 0; padding:10px; background:#f2f2f2; display:inline-block; border-radius:15px; }
.badge { position:absolute; top:-15px; right:-15px; background:#FF6B6B; color:#fff; padding:8px 15px; font-weight:bold; border-radius:50px; font-size:0.9rem; box-shadow:0 4px 10px rgba(0,0,0,0.2); }
</style>
</head>
<body>
<div class="ticket">
    <div class="badge">EvenPass</div>
    <h2>🎟 Billet d'entrée</h2>
    <p><strong>Nom :</strong> <?=htmlspecialchars($billet['nom'])?></p>
    <p><strong>Événement :</strong> <?=htmlspecialchars($billet['event_nom'])?></p>
    <p><strong>Place :</strong> <?=htmlspecialchars($billet['place'])?></p>
    <p><strong>Lieu :</strong> <?=htmlspecialchars($billet['lieu'])?></p>
    <p><strong>Date :</strong> <?=date("d/m/Y H:i", strtotime($billet['date_event']))?></p>
    <div class="qr-code">
        <img src="qrcode.php?token=<?=htmlspecialchars($billet['qr_token'])?>" width="180" alt="QR Code">
    </div>
</div>
</body>
</html>
