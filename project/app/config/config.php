<?php
// Configuration générale de l'application

// Activer le rapport d'erreurs pour le développement
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Démarrer une session pour la gestion des utilisateurs
if (session_status() === PHP_SESSION_NONE) { 
    session_start();
}
?>
