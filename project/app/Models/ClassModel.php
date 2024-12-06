<?php
require_once 'BaseModel.php';

class ClassModel extends BaseModel {
    protected $table = 'class';

    public static function find($id) {
        $stmt = self::$pdo->prepare("SELECT * FROM class WHERE class_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
?>

