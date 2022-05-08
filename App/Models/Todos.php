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

    public static function liveSearch($start, $limit){

        //$query = "SELECT * FROM todos";
        $query = "SELECT todos.*, users.first_name as fn FROM todos
                LEFT JOIN users ON todos.user_id=users.id
                ";

        if($_POST['query'] != ''){
            $query .= '
            WHERE task LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR deadline LIKE "%'.str_replace('', '%', $_POST['query']).'%"             
            ';
        }

        $query .= ' ORDER BY id DESC ';

        $filter_query = $query . 'LIMIT '.$start.','.$limit.'';


        $pdo=Model::getDB();
        $stmt=$pdo->prepare($filter_query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }

    public static function liveSearchCount(){

        $query = "SELECT * FROM todos";

        if($_POST['query'] != ''){
            $query .= '
            WHERE task LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR deadline LIKE "%'.str_replace('', '%', $_POST['query']).'%"              
            ';
        }


        $pdo=Model::getDB();
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();


    }

    public static function update($arr): bool
    {

        $task = $arr['task'];
        $deadline = $arr['deadline'];
        $id = $arr['id'];

        $sql = "UPDATE todos SET task=?, deadline=? WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$task,$deadline,$id]);

    }






}