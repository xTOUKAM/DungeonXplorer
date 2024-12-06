<?php
class HeroController extends BaseController {
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $classId = $_POST['class_id'];
            $userId = $_SESSION['user_id'];

            $heroId = Hero::create($name, $classId);
            UserHero::create($userId, $heroId);

            header('Location: /project/public/profile');
            exit;
        } else {
            $this->render('hero/create');
        }
    }

    public function show($id) {
        $hero = Hero::find($id);
        $this->render('hero/show', ['hero' => $hero]);
    }
}
?>

