<?php

namespace App\Models;

use App\Auth;
use Core\Model;
use PDO;

class Todos extends Model
{
    public static function fetchAll(): array
    {
        $sql = "SELECT todos.*, users.first_name as fn FROM todos
                LEFT JOIN users ON todos.user_id=users.id
                ORDER BY id DESC";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insert($arr): bool
    {

        $task = $arr['task'];
        $deadline = $arr['deadline'];
        $user_id = Auth::getUser()->id;

        $sql = "INSERT INTO todos(task,deadline,user_id) VALUES (?,?,?)";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$task,$deadline,$user_id]);

    }

    public static function fetch($gid){

        $sql = "SELECT * FROM todos WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$gid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



}