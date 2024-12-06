<?php
    require_once 'BaseController.php';
    require_once __DIR__ . '/../Models/Battle.php';

    class BattleController extends BaseController {
        public function index($questId) {
            // Logique pour afficher l'interface de combat
            $battle = Battle::start($questId);
            $this->render('battle/index', ['battle' => $battle]);
        }

        public function result($battleId) {
            // Logique pour afficher le résultat d'un combat
            $battle = Battle::result($battleId);
            $this->render('battle/result', ['battle' => $battle]);
        }
    }
?>
