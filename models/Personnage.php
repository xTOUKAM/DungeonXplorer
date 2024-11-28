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

    // Récupère un monstre par son ID
    public function getMonstre($id) {
        $stmt = $this->bdd->prepare("SELECT * FROM monster WHERE monster_id = :id");
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

    // Permet d'envoyer les données de la base au fichier javascript
    public function getCombatData($personnageId, $monstreId) {
        $personnage = $this->getPersonnage($personnageId);
        $monstre = $this->getMonstre($monstreId);

        if (!$personnage || !$monstre) {
            // Si les données sont invalides, on renvoie une erreur
            echo json_encode(['error' => 'Personnage ou monstre introuvable']);
            exit;  // Arrêter l'exécution du script ici
        }

        // Prépare les données à renvoyer sous forme de tableau associatif simple
        $personnageData = [
            'id' => $personnage['hero_id'],
            'name' => $personnage['name'],
            'pv' => $personnage['pv'],
            'strength' => $personnage['strength'],
            'mana' => $personnage['mana'],
            'armor' => $personnage['armor'],
            'initiative' => $personnage['initiative'],
        ];

        $monstreData = [
            'id' => $monstre['monster_id'],
            'name' => $monstre['name'],
            'hp' => $monstre['hp'],
            'attack' => $monstre['attack'],
        ];

        // Envoie les données en JSON
        header('Content-Type: application/json');
        echo json_encode([
            'personnage' => $personnage,
            'monstre' => $monstre,
        ]);
    }
}
?>