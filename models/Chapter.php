<?php
class Chapter {
    private $bdd;

    public function __construct() {
        $this->bdd = Database::getInstance();
    }

    // Récupère les détails d'un chapitre par ID
    public function getChapterById($chapterId) {
        // Exemple d'une requête SQL
        $query = "SELECT * FROM chapter WHERE chapter_id = :chapterId";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':chapterId', $chapterId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Doit renvoyer un tableau associatif avec 'id', 'content', etc.
    }
    

    // Récupère les liens (liens vers les chapitres suivants)
    public function getLinksForChapter($chapterId) {
        $stmt = $this->bdd->prepare('SELECT * FROM links WHERE links_id = ?');
        $stmt->execute([$chapterId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Trouve l'ID du chapitre suivant basé sur un lien sélectionné
    public function getNextChapterId($currentChapterId, $linkId) {
        $query = "
            SELECT next_chapter_id
            FROM links
            WHERE chapter_id = :currentChapterId AND links_id = :linkId
        ";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':currentChapterId', $currentChapterId, PDO::PARAM_INT);
        $stmt->bindParam(':linkId', $linkId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn(); // Renvoie directement l'ID du prochain chapitre
    }
}
?>
