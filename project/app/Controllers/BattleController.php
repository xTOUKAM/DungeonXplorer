<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../Models/Battle.php';
require_once __DIR__ . '/../Models/Hero.php';
require_once __DIR__ . '/../Models/Monster.php';

class BattleController extends BaseController {
    public function index($heroId) {
        $hero = Hero::find($heroId);
        $monster = Monster::random();

        $result = $this->simulateBattle($hero, $monster);

        $this->render('battle/index', [
            'hero' => $hero,
            'monster' => $monster,
            'result' => $result
        ]);
    }

    private function simulateBattle($hero, $monster) {
        $log = [];
        while ($hero->pv > 0 && $monster->pv > 0) {
            // Hero attacks monster
            $damage = max($hero->strength - $monster->armor, 1);
            $monster->pv -= $damage;
            $log[] = "{$hero->name} inflige {$damage} dégâts à {$monster->name}. PV restant du monstre : {$monster->pv}";

            if ($monster->pv <= 0) {
                $log[] = "{$monster->name} est vaincu !";
                break;
            }

            // Monster attacks hero
            $damage = max($monster->strength - $hero->armor, 1);
            $hero->pv -= $damage;
            $log[] = "{$monster->name} inflige {$damage} dégâts à {$hero->name}. PV restant du héros : {$hero->pv}";

            if ($hero->pv <= 0) {
                $log[] = "{$hero->name} est vaincu !";
                break;
            }
        }

        return $log;
    }
}
?>
