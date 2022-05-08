<?php

namespace App\Models;

use Core\Model;
use PDO;

class Staff extends Model
{

    public static function liveSearch($start, $limit){

        $query = "SELECT * FROM users WHERE (type='Staff') ";

        if($_POST['query'] != ''){
            $query .= '
            AND ( first_name LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR last_name LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR email LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            )';
        }

        $query .= " ORDER BY id DESC ";

        $filter_query = $query . 'LIMIT '.$start.','.$limit.'';

        $pdo=Model::getDB();
        $stmt=$pdo->prepare($filter_query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public static function liveSearchCount(): int
    {

        $query = "SELECT * FROM users WHERE (type='Staff') ";

        if($_POST['query'] != ''){
            $query .= '
            AND ( first_name LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR last_name LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR email LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            )';
        }

        $pdo=Model::getDB();
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();

    }

}