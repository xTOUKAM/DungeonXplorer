<?php
    require_once 'BaseModel.php';

    class Battle extends BaseModel {
        protected $table = 'battles';

        public static function start($questId) {
            // Logique pour démarrer un combat
            // Exemple simplifié
            $stmt = self::$pdo->prepare("INSERT INTO battles (quest_id) VALUES (?)");
            $stmt->execute([$questId]);
            return self::$pdo->lastInsertId();
        }

        public static function result($battleId) {
            // Logique pour obtenir le résultat d'un combat
            $stmt = self::$pdo->prepare("SELECT * FROM battles WHERE battle_id = ?");
            $stmt->execute([$battleId]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
    }
?>
