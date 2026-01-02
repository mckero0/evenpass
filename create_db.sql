-- Création de la base
CREATE DATABASE IF NOT EXISTS eventpass CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Utiliser la base
USE eventpass;

-- Création de la table billets
CREATE TABLE IF NOT EXISTS billets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    event_nom VARCHAR(100),
    qr_token VARCHAR(64) UNIQUE,
    statut ENUM('valide','utilise') DEFAULT 'valide',
    date_scan DATETIME NULL
);

-- Ajouter un billet exemple
INSERT INTO billets (nom, event_nom, qr_token)
VALUES ('Alice Dupont', 'DevConf 2026', 'testtoken123456');
