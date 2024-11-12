<?php
class Chapter {
    private $bdd;

    public function __construct() {
        $this->bdd = Database::getInstance();
    }

    // Récupère le contenu d'un chapitre par son ID
    public function getChapterById($id) {
        $id = (int)$id; // Conversion en entier pour sécuriser la requête
        try {
            $stmt = $this->bdd->prepare("SELECT * FROM Chapter WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer l'erreur ici (log, message, etc.)
            return null;
        }
    }

    // Récupère l'ID du prochain chapitre en fonction du chapitre actuel et du choix
    public function getNextChapterId($currentChapterId, $choiceId) {
        // Conversion explicite en entier
        $currentChapterId = (int)$currentChapterId;
        $choiceId = (int)$choiceId;
        
        try {
            error_log("Exécution de la requête : SELECT next_chapter_id FROM Choices WHERE chapter_id = $currentChapterId AND choice_id = $choiceId");
            
            $stmt = $this->bdd->prepare("SELECT next_chapter_id FROM Choices WHERE chapter_id = ? AND choice_id = ?");
            $stmt->execute([$currentChapterId, $choiceId]);
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                error_log("Prochain chapitre trouvé: " . $result['next_chapter_id']);
                return $result['next_chapter_id'];
            } else {
                error_log("Aucun prochain chapitre trouvé pour les paramètres donnés.");
                return null;
            }
        } catch (PDOException $e) {
            error_log("Erreur SQL: " . $e->getMessage());
            return null;
        }
    }                 

    // Récupère les choix pour un chapitre donné
    public function getChoicesForChapter($chapterId) {
        try {
            $stmt = $this->bdd->prepare("SELECT choice_id, description FROM Choices WHERE chapter_id = ?");
            $stmt->execute([$chapterId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer l'erreur ici (log, message, etc.)
            return [];
        }
    }
}
?>
