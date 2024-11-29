<?php

class CombatMonster{
    private $bdd;

    public function __construct() {
        $this->bdd =  Database::getInstance();
    }

    // Récupère un monstre par son ID
    public function getMonstre($id) {
        $stmt = $this->bdd->prepare("SELECT * FROM monster WHERE monster_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
}

?>
