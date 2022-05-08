<?php

namespace App\Models;

use Core\Model;
use PDO;

class Expense extends Model
{
    public static function fetchAll(): array
    {
        $sql = "SELECT * FROM expenses ORDER BY id DESC";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insert($arr): bool
    {

        $amount = $arr['amount'];
        $tag = $arr['tag'];
        $date = $arr['date'];

        $sql = "INSERT INTO expenses(amount,tag,dated) VALUES (?,?,?)";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$amount,$tag,$date]);

    }

    public static function fetch($gid){

        $sql = "SELECT * FROM expenses WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$gid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function liveSearch($start, $limit){

        $query = "SELECT * FROM expenses";

        if($_POST['query'] != ''){
            $query .= '
            WHERE dated LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR tag LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR amount LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
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

        $query = "SELECT * FROM expenses";

        if($_POST['query'] != ''){
            $query .= '
            WHERE dated LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR tag LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR amount LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            ';
        }


        $pdo=Model::getDB();
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();


    }


    public static function update($arr): bool
    {

        $amount = $arr['amount'];
        $tag = $arr['tag'];
        $date = $arr['date'];
        $id = $arr['id'];

        $sql = "UPDATE expenses SET amount=?, tag=?, dated=? WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$amount,$tag,$date,$id]);

    }





}