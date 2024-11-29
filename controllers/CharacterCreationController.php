<?php
class CharacterCreationController {
    private $characterModel;

    public function __construct() {
        $this->characterModel = new Character();
    }

    public function creation() {
    
        $character = $this->characterModel->createACharacter();
    
        if (!$character) {
            echo "Échec de la création de votre personnage ...";
            return;
        }
    
        /*
        
        TODO : modifier pour rediriger vers le début de la campagne

        extract(['character' => $character]);
        include __DIR__ . '/../views/chapter.php';

        */
    }      
            
    /*public function choose($currentChapterId, $choiceId) {
        // Valider les IDs pour éviter des erreurs
        $currentChapterId = (int)$currentChapterId;
        $choiceId = (int)$choiceId;
    
        // Récupérer l'ID du prochain chapitre en fonction du choix
        $nextChapterId = $this->characterModel->getNextChapterId($currentChapterId, $choiceId);
    
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
    }*/
            
}
?>