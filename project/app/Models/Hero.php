<?php
require_once 'BaseModel.php';

class Hero extends BaseModel {
    protected $table = 'hero';

    public static function create($name, $classId) {
        $stmt = self::$pdo->prepare("INSERT INTO hero (name, class_id, pv, mana, strength, initiative) VALUES (?, ?, ?, ?, ?, ?)");
        $class = ClassModel::find($classId);
        $stmt->execute([$name, $classId, $class->base_pv, $class->base_mana, $class->strength, $class->initiative]);
        return self::$pdo->lastInsertId(); // Retourne l'ID du héros nouvellement créé
    }

    public static function find($id) {
        $stmt = self::$pdo->prepare("SELECT * FROM hero WHERE hero_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
?>
