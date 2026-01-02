<?php
require 'db.php';
$token = $_GET['token'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM billets WHERE qr_token=?");
$stmt->execute([$token]);
$billet = $stmt->fetch();

if (!$billet) {
    die("Billet invalide !");
}

// Marquer comme utilisé si nécessaire
if ($billet['statut'] === 'valide') {
    $stmt = $pdo->prepare("UPDATE billets SET statut='utilise', date_scan=NOW() WHERE qr_token=?");
    $stmt->execute([$token]);
    echo "Billet valide. Bienvenue ".$billet['nom']." !";
} else {
    echo "Billet déjà utilisé.";
}
?>
