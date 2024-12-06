<?php
require_once 'BaseModel.php';

class Chapter extends BaseModel {
    protected $table = 'chapter'; // Nom de la table pour les chapitres

    public static function findCurrentByQuestId($chapterId) {
        // Logique pour trouver le chapitre actuel de la quête
        $stmt = self::$pdo->prepare("SELECT * FROM chapter WHERE chapter_id = ?");
        $stmt->execute([$chapterId]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function findNextChapters($currentChapterId) {
        // Logique pour trouver les chapitres suivants
        $stmt = self::$pdo->prepare("SELECT * FROM links WHERE chapter_id = ?");
        $stmt->execute([$currentChapterId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>
