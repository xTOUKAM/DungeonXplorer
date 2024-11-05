<?php
    $envFile = __DIR__ . '/.env';

    if(!file_exists($envFile)) {
        throw new Exception('Le fichier .env est manquant');
    }

    $env = parse_ini_file($envFile);

    if(!isset($env['DB_HOST'], $env['DB_NAME'], $env['DB_USER'], $env['DB_PASSWORD'])) {
        throw new Exception('Le fichier .env est mal configuré');
    }

    // Connexion à la base de données
    try {
        $bdd = new PDO(
            'mysql:host=' . $env['DB_HOST'] . ';dbname=' . $env['DB_NAME'] . ';charset=utf8',
            $env['DB_USER'],
            $env['DB_PASSWORD']
        );
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
?>