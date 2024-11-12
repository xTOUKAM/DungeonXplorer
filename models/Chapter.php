<?php
    class Chapter {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        // Récupère le contenu d'un chapitre par son ID
        public function getChapterById($id) {
            $stmt = $this->db->prepare("SELECT * FROM Chapter WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Logique de choix du prochain chapitre (simplifiée ici)
        public function getNextChapter($currentChapterId, $choice) {
            if ($choice == 'choix1') {
                return $currentChapterId + 1; // Aller au chapitre suivant
            } elseif ($choice == 'choix2') {
                return $currentChapterId + 2; // Aller à un chapitre alternatif
            }
            return $currentChapterId;
        }
    }
?>
