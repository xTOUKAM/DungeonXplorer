<?php
class Database {
    private static $instance = null;
    private $bdd;

    // Constructeur privé pour empêcher l'instanciation extérieure
    private function __construct() {
        $envFile = __DIR__ . '/../config/.env';

        if (!file_exists($envFile)) {
            throw new Exception('Le fichier .env est manquant');
        }

        $env = parse_ini_file($envFile);

        if (!isset($env['DB_HOST'], $env['DB_NAME'], $env['DB_USER'], $env['DB_PASSWORD'])) {
            throw new Exception('Le fichier .env est mal configuré');
        }

        // Connexion à la base de données
        try {
            $this->bdd = new PDO(
                'mysql:host=' . $env['DB_HOST'] . ';dbname=' . $env['DB_NAME'] . ';charset=utf8',
                $env['DB_USER'],
                $env['DB_PASSWORD']
            );
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    // Méthode pour obtenir l'instance de la base de données (singleton)
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->bdd;
    }
}
?>