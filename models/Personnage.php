<?php
class Personnage {
    private $bdd;

    public function __construct() {
        $this->bdd =  Database::getInstance();
    }

    // Récupère un personnage par son ID
    public function getPersonnage($id) {
        $stmt = $this->bdd->prepare("SELECT concat(class.name, ' ', hero.name) as name, class.base_pv, class.base_mana, hero.pv, hero.mana, hero.strength, hero.initiative, hero.armor  FROM hero 
        Join class on hero.class_id = class.class_id 
        WHERE hero_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Met à jour les statistiques du personnage
    public function updatePersonnage($id, $mana_actu, $pv_actu) {
        $stmt = $this->bdd->prepare("
            UPDATE hero 
            SET pv = :pv, mana = :mana
            WHERE hero_id = :id
        ");
        return $stmt->execute(['pv' => $pv_actu, 'mana' => $mana_actu, 'id' => $id]);
    }

    public function getSpeels($id){
        $requete = $this->bdd->prepare("SELECT spell_name, damage, mana_cost from spells
        join hero_spell using (spell_id)
        where hero_id = :id");
        $requete->execute(['id' => $id]);
        return $requete->fetch(PDO::FETCH_ASSOC);


    }
}
?>