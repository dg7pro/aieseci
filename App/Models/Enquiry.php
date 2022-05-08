<?php

namespace App\Models;

use Core\Model;
use PDO;

class Enquiry extends Model
{

    public static function insert($arr): bool
    {

        $name = $arr['name'];
        $mobile = $arr['mobile'];
        $email = $arr['email'];
        $message = $arr['message'];

        $sql = "INSERT INTO queries (name,mobile,email,message) VALUES (?,?,?,?)";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$name,$mobile,$email,$message]);

    }


    public static function liveSearch($start, $limit){

        $query = "SELECT * FROM enquires";

        if($_POST['query'] != ''){
            $query .= '
            WHERE name LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR mobile LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR email LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            ';
        }

        $query .= ' ORDER BY id DESC ';

        $filter_query = $query . 'LIMIT '.$start.','.$limit.'';


        $pdo=Model::getDB();
        $stmt=$pdo->prepare($filter_query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }

    public static function liveSearchCount(): int
    {

        $query = "SELECT * FROM enquires";

        if($_POST['query'] != ''){
            $query .= '
            WHERE name LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR mobile LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR email LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            ';
        }


        $pdo=Model::getDB();
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();


    }

    public static function fetch($id){

        $sql = "SELECT * FROM enquires WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($arr): bool
    {
//        var_dump($arr);
//        exit();
        $response = $arr['cs'];
        $note = $arr['note'];
        $id = $arr['id'];

        $sql = "UPDATE enquires SET response=?, note=? WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$response,$note,$id]);

    }





}