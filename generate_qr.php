<?php
require __DIR__ . '/vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

// Dossier pour les QR Codes
$folder = __DIR__ . "/qrcodes/";
if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
}

$qrcode_file = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['texte'])) {
    $texte = trim($_POST['texte']);

    // Génération du QR Code
    $result = Builder::builder()
        ->writer(new PngWriter())
        ->data($texte)
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(300)
        ->margin(10)
        ->build();

    // Nom unique pour le fichier QR
    $file_name = "qrcode_" . time() . ".png";
    $qrcode_file = $folder . $file_name;
    $result->saveToFile($qrcode_file);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Générateur de QR Code</title>
    <style>
        body { font-family: Arial; text-align: center; padding: 50px; background: #f5f5f5; }
        form { margin-bottom: 30px; }
        input[type="text"] { padding: 10px; width: 300px; font-size: 16px; }
        input[type="submit"] { padding: 10px 20px; font-size: 16px; }
        .qrcode-container { background: #fff; display: inline-block; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.2); }
        img { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Générateur de QR Code</h1>
    <form method="post">
        <input type="text" name="texte" placeholder="Entrez votre texte ici" required>
        <input type="submit" value="Générer QR Code">
    </form>

    <?php if ($qrcode_file): ?>
        <div class="qrcode-container">
            <h2>Votre QR Code</h2>
            <p><?php echo htmlspecialchars($texte); ?></p>
            <img src="<?php echo "qrcodes/" . basename($qrcode_file); ?>" alt="QR Code">
        </div>
    <?php endif; ?>
</body>
</html>
