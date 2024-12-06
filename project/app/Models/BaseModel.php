<?php
class BaseModel {
    protected static $pdo;

    public static function setPDO($pdo) {
        self::$pdo = $pdo;
    }
}
?>
