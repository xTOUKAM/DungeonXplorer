<?php

class ChapterController {
    private $chapterModel;

    public function __construct() {
        $this->chapterModel = new Chapter();
    }

    public function show($chapterId = 1) {
        $chapterId = (int)$chapterId; // Sécurise l'ID du chapitre
        $chapter = $this->chapterModel->getChapterById($chapterId);
        
        if (!$chapter) {
            echo "Chapitre non trouvé.";
            return;
        }
    
        // Récupérer les choix associés au chapitre
        $choices = $this->chapterModel->getChoicesForChapter($chapterId);
    
        // Passe les variables à la vue
        extract(['chapter' => $chapter, 'choices' => $choices]);
    
        // Inclure la vue
        include __DIR__ . '/../views/chapter.php';
    }        

    // Gérer le choix du joueur
    public function choose($params) {
        // Valider les IDs pour éviter des erreurs
        $currentChapterId = isset($params['currentChapterId']) ? (int)$params['currentChapterId'] : 1;
        $choiceId = isset($params['choice']) ? (int)$params['choice'] : null;

        // Récupérer l'ID du prochain chapitre en fonction du choix
        $nextChapterId = $this->chapterModel->getNextChapterId($currentChapterId, $choiceId);

        if ($nextChapterId) {
            // Empêcher la mise en cache de la page
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Pragma: no-cache");

            // Rediriger vers le prochain chapitre
            header('Location: /DungeonXplorer/index.php?controller=ChapterController&action=show&chapterId=' . $nextChapterId);
            exit();  // Toujours appeler exit après une redirection pour éviter l'exécution de code après la redirection
        } else {
            echo "Choix invalide ou chapitre suivant introuvable.";
        }
    }
}
?>
