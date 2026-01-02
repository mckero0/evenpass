<?php
require 'db.php';

// Données exemple
$nom = "Jean Dupont";
$event = "DevConf 2026";
$place = "A12";               // nouvelle info
$lieu = "Centre des Congrès"; // nouvelle info
$date_event = "2026-03-15 18:00:00"; // nouvelle info

// Générer token unique
$token = bin2hex(random_bytes(16));

// Insérer le billet
$stmt = $pdo->prepare("
    INSERT INTO billets (nom, event_nom, qr_token, place, lieu, date_event)
    VALUES (?, ?, ?, ?, ?, ?)
");
$stmt->execute([$nom, $event, $token, $place, $lieu, $date_event]);

// Rediriger vers le billet
header("Location: ticket.php?token=$token");
exit;
?>
