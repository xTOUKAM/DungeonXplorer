<?php
class ChapterController {
    private $chapterModel;

    public function __construct() {
        $this->chapterModel = new Chapter();
    }

    public function show($chapterId = 1) {
        var_dump($chapterId); // Vérifiez si le chapitre est correctement passé
    
        $chapter = $this->chapterModel->getChapterById($chapterId);
    
        if (!$chapter) {
            echo "Chapitre non trouvé pour l'ID : " . htmlspecialchars($chapterId);
            return;
        }
    
        extract(['chapter' => $chapter]);
        include __DIR__ . '/../views/chapter.php';
    }      
            
    public function choose($currentChapterId, $choiceId) {
        // Valider les IDs pour éviter des erreurs
        $currentChapterId = (int)$currentChapterId;
        $choiceId = (int)$choiceId;
    
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
