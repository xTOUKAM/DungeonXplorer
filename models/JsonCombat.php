<?php
require_once '../controllers/Database.php'; // Inclure la classe Database
require_once 'Personnage.php'; // Inclure le modèle Personnage
require_once 'CombatMonster.php'; // Inclure le modèle du monstre

// Initialisation
$personnageModel = new Personnage();
$monstreModel = new CombatMonster();

// Récupération d'un héros et d'un monstre
$personnageId = 2; // A recuperer dynamiquement grâce a l'utilisateur
$monstreId = 2;    // A recuperer dynamiquement grâce au monstre lié au chapitre

$personnage = $personnageModel->getPersonnage($personnageId);
$monstre = $monstreModel->getMonstre($monstreId);

if (!$personnage || !$monstre) {
    // Si les données sont invalides, on renvoie une erreur
    echo json_encode(['error' => 'Personnage ou monstre introuvable']);
    exit;  // Arrêter l'exécution du script ici
}

// Envoie les données en JSON
header('Content-Type: application/json');
echo json_encode([
    'personnage' => $personnage,
    'monstre' => $monstre
]);


