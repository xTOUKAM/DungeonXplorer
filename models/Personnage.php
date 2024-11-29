<?php
class Personnage {
    private $bdd;

    public function __construct() {
        $this->bdd =  Database::getInstance();
    }

    // Récupère un personnage par son ID
    public function getPersonnage($id) {
        $stmt = $this->bdd->prepare("SELECT * FROM hero WHERE hero_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Met à jour les statistiques du personnage
    public function updatePersonnage($id, $mana_actu, $pv_actu) {
        $stmt = $this->bdd->prepare("
            UPDATE personnages 
            SET pv = :pv, mana = :mana
            WHERE id = :id
        ");
        return $stmt->execute(['pv' => $pv_actu, 'mana' => $mana_actu, 'id' => $id]);
    }
}
?>