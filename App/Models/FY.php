<?php

namespace App\Models;

use Core\Model;
use PDO;

class FY extends Model
{

    public static function fetchAll(): array
    {
        $sql = "SELECT * FROM sessions";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function current()
    {
        $sql = "SELECT * FROM sessions WHERE active =1";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }


}