<?php
require_once 'Database.php'; // Inclure la classe Database
require_once '../models/Personnage.php'; // Inclure le modèle Personnage

// Initialisation
$personnageModel = new Personnage();

// Récupération d'un héros et d'un monstre
$personnageId = 1; // Exemple d'ID
$monstreId = 2;    // Exemple d'ID

$personnage = $personnageModel->getPersonnage($personnageId);
$monstre = $personnageModel->getMonstre($monstreId);

// Inclusion de la vue pour afficher les données
require '../views/combat.php';
