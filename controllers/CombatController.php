<?php
require_once 'Database.php'; // Inclure la classe Database
require_once '../models/Personnage.php'; // Inclure le modèle Personnage

// Initialisation
$personnageModel = new Personnage();

// Récupération d'un héros et d'un monstre
$personnageId = 1; // A recuperer dynamiquement grâce a l'utilisateur
$monstreId = 2;    // A recuperer dynamiquement grâce au monstre lié au chapitre

$personnage = $personnageModel->getPersonnage($personnageId);
$monstre = $personnageModel->getMonstre($monstreId);

$personnageModel->getCombatData($personnage,$monstre);

// Inclusion de la vue pour afficher les données
require '../views/combat.php';
