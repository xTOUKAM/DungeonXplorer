<?php
    class ChapterController {
        private $chapterModel;

        public function __construct() {
            $this->chapterModel = new Chapter();
        }

        public function show($chapterId = 1) {
            $chapter = $this->chapterModel->getChapterById($chapterId);
            $choices = $this->chapterModel->getChoicesForChapter($chapterId);
        
            if (!$chapter) {
                echo "Chapitre non trouvé pour l'ID : " . htmlspecialchars($chapterId);
                return;
            }
        
            // Utilisation d'extract dans le contrôleur
            extract(['chapter' => $chapter]);
            include 'views/chapter.php';
        }            

        // On gère la transition des chapitres en fonction des choix
        public function choose($currentChapterId, $choiceId) {
            // Valider les IDs pour éviter des erreurs
            $currentChapterId = (int)$currentChapterId;
            $choiceId = (int)$choiceId;

            $nextChapterId = $this->chapterModel->getNextChapterId($currentChapterId, $choiceId);

            if ($nextChapterId) {
                $this->show($nextChapterId);
            } else {
                echo "Choix invalide ou chapitre suivant introuvable.";
            }
        }
    }
?>