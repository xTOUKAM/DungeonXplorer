<?php
require_once 'BaseModel.php';

class Quest extends BaseModel {
    protected $table = 'quest'; // Utilise la table existante

    public static function isActive($heroId) {
        $stmt = self::$pdo->prepare('SELECT COUNT(*) FROM quest WHERE hero_id = :hero_id');
        $stmt->execute(['hero_id' => $heroId]);
        return $stmt->fetchColumn() > 0;
    }
    
    public static function getActiveQuestId($heroId) {
        $stmt = self::$pdo->prepare('SELECT quest_id FROM quest WHERE hero_id = :hero_id AND chapter_id = 1 LIMIT 1');
        $stmt->execute(['hero_id' => $heroId]);
        return $stmt->fetchColumn();
    }
    

    public static function start($heroId) {
        // Logique pour démarrer une nouvelle quête
        $stmt = self::$pdo->prepare("INSERT INTO quest (hero_id, chapter_id) VALUES (?, 1)"); // On commence avec le premier chapitre
        $stmt->execute([$heroId]);
        return self::$pdo->lastInsertId(); // Retourner l'ID de la nouvelle quête
    }

    public static function find($questId) {
        $stmt = self::$pdo->prepare("SELECT * FROM quest WHERE quest_id = ?");
        $stmt->execute([$questId]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
?>
