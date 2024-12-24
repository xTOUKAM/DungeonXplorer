<?php
require_once '../controllers/Database.php'; // Inclure la classe Database
require_once 'Personnage.php'; // Inclure le modèle Personnage

// Initialisation
$personnageModel = new Personnage();

// Récupère les données envoyées depuis le client (POST)
$id       = $_POST['id'];
$pv_actu  = $_POST['pv'];
$mana_actu= $_POST['mana'];

// Récupération d'un héros et d'un monstre
$personnageId = 1; // A recuperer dynamiquement grâce a l'utilisateur

$success = $personnageModel->updatePersonnage($id, $mana_actu, $pv_actu);

if ($success) {
    echo json_encode(["status" => "success", "message" => "Personnage mis à jour"]);
} else {
    echo json_encode(["status" => "error", "message" => "Erreur de mise à jour"]);
}
?>