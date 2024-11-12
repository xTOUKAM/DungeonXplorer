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
            $stmt = $this->bdd->prepare("SELECT next_chapter_id FROM Choices WHERE chapter_id = ? AND choice_id = ?");
            $stmt->execute([$currentChapterId, $choiceId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
            var_dump($result); // Débogage pour voir si les données sont retournées correctement
            
            return $result ? $result['next_chapter_id'] : null; // Retourne null si pas de chapitre suivant
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