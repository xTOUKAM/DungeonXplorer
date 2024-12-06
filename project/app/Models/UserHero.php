<?php
require_once 'BaseModel.php';

class UserHero extends BaseModel {
    protected $table = 'user_hero'; 
    
    public static function create($userId, $heroId) { 
        $stmt = self::$pdo->prepare("INSERT INTO user_hero (user_id, hero_id) VALUES (?, ?)"); $stmt->execute([$userId, $heroId]); 
    }

    public static function findByUserId($userId) {
        $stmt = self::$pdo->prepare("
            SELECT h.hero_id, h.name, h.class_id, h.current_level
            FROM hero h
            JOIN user_hero uh ON h.hero_id = uh.hero_id
            WHERE uh.user_id = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>
