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
        // Assurez-vous de récupérer correctement les paramètres de l'URL
        $currentChapterId = isset($_GET['currentChapterId']) ? (int)$_GET['currentChapterId'] : 1;
        $choiceId = isset($_GET['choice']) ? (int)$_GET['choice'] : null;
    
        // Vérifiez si le choix est null
        if ($choiceId === null) {
            echo "Aucun choix sélectionné.";
            return;
        }
    
        // Log des paramètres pour vérifier
        error_log("Chapitre actuel: $currentChapterId, Choix sélectionné: $choiceId");
    
        // Récupérer l'ID du prochain chapitre en fonction du choix
        $nextChapterId = $this->chapterModel->getNextChapterId($currentChapterId, $choiceId);
    
        // Log du résultat
        error_log("ID du prochain chapitre: " . ($nextChapterId ? $nextChapterId : "Aucun"));
    
        if ($nextChapterId) {
            // Rediriger vers le prochain chapitre
            header('Location: /DungeonXplorer/index.php?controller=ChapterController&action=show&chapterId=' . $nextChapterId);
            exit();
        } else {
            echo "Choix invalide ou chapitre suivant introuvable.";
        }
    }            
}
?>
