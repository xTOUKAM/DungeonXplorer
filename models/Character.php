<?php
    class Character {
        private $bdd;

        public function __construct() {
            $this->bdd = Database::getInstance();
        }

        // Récupère le contenu d'un chapitre par son ID
        public function createACharacter() {
            /*$id = (int)$id; // Conversion en entier pour sécuriser la requête
            $stmt = $this->bdd->prepare("SELECT * FROM Chapter WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);*/
        }

        // Récupère l'ID du prochain chapitre en fonction du chapitre actuel et du choix
        public function getNextChapterId($currentChapterId, $choiceId) {
            $stmt = $this->bdd->prepare("SELECT next_chapter_id FROM Choices WHERE chapter_id = ? AND choice_id = ?");
            $stmt->execute([$currentChapterId, $choiceId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            var_dump($result); // Vérifiez si le résultat est correct
        
            return $result ? $result['next_chapter_id'] : null; // Retourne null si pas de chapitre suivant
        }                

        public function getChoicesForChapter($chapterId) {
            $stmt = $this->bdd->prepare("SELECT choice_id, description FROM Choices WHERE chapter_id = ?");
            $stmt->execute([$chapterId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>