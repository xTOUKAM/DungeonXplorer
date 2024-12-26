<?php

require_once 'BaseModel.php';

<?php
require_once 'BaseModel.php';

class Monster extends BaseModel {
    protected $table = 'monsters';

    public static function find($id) {
        $stmt = self::$pdo->prepare("SELECT * FROM monster WHERE monster_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function random() {
        $stmt = self::$pdo->query("SELECT * FROM monster ORDER BY RAND() LIMIT 1");
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
?>
