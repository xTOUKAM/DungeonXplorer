<?php
    class ChapterController {
        private $chapterModel;

        public function __construct() {
            $this->chapterModel = new Chapter();
        }

        public function show($chapterId = 1) {
            $chapter = $this->chapterModel->getChapterById($chapterId);
            require 'views/chapter.php';
        }

        // On gère la transition des chapitres en fonction des choix
        public function choose ($currentChapterId, $choiceId) {
            $nextChapterId = $this->chapterModel->getNextChapterId($currentChapterId, $choiceId);
            $this->show($nextChapterId);
        }
    }
?>