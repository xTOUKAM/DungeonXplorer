<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../Models/Quest.php';
require_once __DIR__ . '/../Models/Chapter.php';

class QuestController extends BaseController {
    public function isQuestActive($heroId) {
        // Logique pour vérifier si une quête est active
        return Quest::isActive($heroId);
    }

    public function start($heroId) {
        if ($this->isQuestActive($heroId)) {
            // Redirection vers la progression si la quête est déjà commencée
            $questId = Quest::getActiveQuestId($heroId); // Méthode pour récupérer l'ID de la quête active
            header('Location: /project/public/quest/progress?quest_id=' . $questId);
        } else {
            // Démarre une nouvelle quête
            $questId = Quest::start($heroId);
            header('Location: /project/public/quest/progress?quest_id=' . $questId);
        }
        exit();
    }

    public function progress($chapterId) {
        // Logique pour afficher la progression d'une quête
        $chapter = Chapter::findCurrentByQuestId($chapterId); // Utilisation de chapter_id pour trouver le chapitre courant
        $nextChapters = Chapter::findNextChapters($chapter->chapter_id); // Utilisation du chapitre courant pour trouver les chapitres suivants
        $this->render('quest/progress', ['chapter' => $chapter, 'nextChapters' => $nextChapters, 'quest' => (object)['chapter_id' => $chapterId]]);
    }
}
?>
