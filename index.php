<?php
require 'db.php';

$nom = $_POST['nom'] ?? '';
$event = $_POST['event'] ?? '';
$place = $_POST['place'] ?? '';
$lieu = $_POST['lieu'] ?? '';
$date_event = $_POST['date_event'] ?? '';

if ($nom && $event && $place && $lieu && $date_event) {
    $token = bin2hex(random_bytes(16));
    $stmt = $pdo->prepare("
        INSERT INTO billets (nom, event_nom, qr_token, place, lieu, date_event)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$nom, $event, $token, $place, $lieu, $date_event]);
    header("Location: ticket.php?token=$token");
    exit;
} else {
    echo "Tous les champs sont requis !";
}
?>
