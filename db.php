<?php
// db.php - connexion PDO sécurisée avec variables d'environnement

// Récupération des informations depuis les variables d'environnement
$host = getenv('DB_HOST');       // Ex: fourni par Render
$db   = getenv('DB_NAME');       // Nom de la base
$user = getenv('DB_USER');       // Utilisateur MySQL
$pass = getenv('DB_PASS');       // Mot de passe
$port = getenv('DB_PORT') ?: 3306; // Port MySQL, par défaut 3306

// Options PDO pour sécurité et compatibilité
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Active les exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Résultat en tableau associatif
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Utiliser les vrais prepared statements
];

try {
    // Connexion PDO
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        $options
    );
} catch (PDOException $e) {
    // En cas d'erreur de connexion
    http_response_code(500);
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit;
}
?>
