<?php
// Configuration de la base de données MySQL
$host = '127.0.0.1';
$db   = 'dungeonxplorer';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// Inclure le modèle de base
require_once __DIR__ . '/../Models/BaseModel.php';

// DSN (Data Source Name) pour la connexion à la base de données
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Options pour PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Création de la connexion PDO
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Définir PDO dans les modèles
BaseModel::setPDO($pdo);
?>
