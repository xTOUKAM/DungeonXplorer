<?php
class User extends BaseModel {
    public static function create($username, $password) {
        $hashedPassword = md5($password);
        echo "Creating user with hashed password: " . $hashedPassword . "<br>";
        $sql = 'INSERT INTO user (user_name, user_password) VALUES (:username, :password)';
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $hashedPassword]);
    }

    public static function findByUsername($username) {
        $sql = 'SELECT * FROM user WHERE user_name = :username';
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }

    public static function authenticate($username, $password) {
        $sql = 'SELECT * FROM user WHERE user_name = :username';
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user) {
            if (md5($password) === $user['user_password']) {
                return $user;
            } else {
                echo "Vérification du mot de passe échouée <br>";
            }
        } else {
            echo "Utilisateur non trouvée !<br>";
        }
        return false;
    }

    public static function findById($user_id) {
        $sql = 'SELECT * FROM user WHERE user_id = :user_id';
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        $user = $stmt->fetch();
        return $user;
    }
}
?>
