<?php

namespace App\Models;

use Core\Model;
use PDO;

class Query extends Model
{

    public static function fetch($gid){

        $sql = "SELECT * FROM queries WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$gid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($arr): bool
    {

//        var_dump($arr);
//        exit();
        $name = $arr['name'];
        $subject = $arr['subject'];
        $message = $arr['message'];
        $id = $arr['id'];

        $sql = "UPDATE queries SET name=?, subject=?, message=? WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$name,$subject,$message,$id]);

    }

    public static function liveSearch($start, $limit){

        $query = "SELECT * FROM queries";

        if($_POST['query'] != ''){
            $query .= '
            WHERE name LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR email LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR mobile LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            ';
        }

        $query .= ' ORDER BY id DESC ';

        $filter_query = $query . 'LIMIT '.$start.','.$limit.'';


        $pdo=Model::getDB();
        $stmt=$pdo->prepare($filter_query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);


    }

    public static function liveSearchCount(){

        $query = "SELECT * FROM queries";

        if($_POST['query'] != ''){
            $query .= '
            WHERE name LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR email LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR mobile LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            ';
        }


        $pdo=Model::getDB();
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();


    }

}