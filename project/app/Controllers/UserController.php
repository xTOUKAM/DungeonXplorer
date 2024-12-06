<?php
class UserController extends BaseController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            echo "Received username: " . $username . "<br>";
            echo "Received password: " . $password . "<br>";

            User::create($username, $password);
            header('Location: /project/public/login');
            exit;
        } else {
            $this->render('user/register');
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            echo "Received username: " . $username . "<br>";
            echo "Received password: " . $password . "<br>";

            $user = User::authenticate($username, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['user_id'];
                header('Location: /project/public/profile');
                exit;
            } else {
                $this->render('user/login', ['error' => 'Nom d\'utilisateur ou mot de passe incorrect']);
            }
        } else {
            $this->render('user/login');
        }
    }

    public function profile() {
        if (isset($_SESSION['user_id'])) {
            $user = User::findById($_SESSION['user_id']);
            $heroes = UserHero::findByUserId($_SESSION['user_id']);
            $this->render('user/profile', ['user' => $user, 'heroes' => $heroes]);
        } else {
            header('Location: /project/public/login');
            exit;
        }
    }
}
?>