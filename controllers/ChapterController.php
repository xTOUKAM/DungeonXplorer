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
    
        // Récupérer les liens associés au chapitre
        $links = $this->chapterModel->getLinksForChapter($chapterId);
    
        // Passe les variables à la vue
        extract(['chapter' => $chapter, 'links' => $links]);
    
        // Inclure la vue
        include __DIR__ . '/../views/chapter.php';
    }     

    // Gérer le choix du joueur
    public function choose($params) {
        // Récupérer l'ID du chapitre actuel et l'ID du lien sélectionné
        $currentChapterId = isset($_GET['currentChapterId']) ? (int)$_GET['currentChapterId'] : 1;
        $linkId = isset($_GET['link']) ? (int)$_GET['link'] : null;
    
        if ($linkId === null) {
            echo "Aucun lien sélectionné.";
            return;
        }
    
        // Récupérer l'ID du prochain chapitre
        $nextChapterId = $this->chapterModel->getNextChapterId($currentChapterId, $linkId);
    
        if ($nextChapterId) {
            // Rediriger vers le prochain chapitre
            header('Location: /DungeonXplorer/index.php?controller=ChapterController&action=show&chapterId=' . $nextChapterId);
            exit();
        } else {
            echo "Lien invalide ou chapitre suivant introuvable.";
        }
    }                 
}
?>
