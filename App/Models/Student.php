<?php

namespace App\Models;

use Core\Model;
use PDO;

class Student extends Model
{
    public static function createAccount($arr): bool
    {
        $first_name = $arr['first_name'];
        $last_name = $arr['last_name'];
        $mobile = $arr['mobile'];
        $email = $arr['email'];
        $password_hash = password_hash($arr['password'], PASSWORD_DEFAULT);
        $type = 'Student';


        $sql = "INSERT INTO users(first_name,last_name,mobile,email,password_hash,is_active,tnc,type) VALUES (?,?,?,?,?,?,?,?)";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$first_name,$last_name,$mobile,$email,$password_hash,1,1,$type]);

    }

    /*
     * CRUD Read
     * */

    public static function liveSearch($start, $limit){

        $query = "SELECT * FROM users WHERE (type='Student') ";

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

        $query = "SELECT * FROM users WHERE (type='Student') ";

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

    public static function fetchComplete($gid){

        $type = 'Student';
        $sql = "SELECT users.*, si.enroll_no FROM users  
                LEFT JOIN student_info AS si ON si.user_id=users.id 
                WHERE users.id=? AND users.type=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$gid,$type]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function fetch($id){

        $type = 'Student';
        $sql = "SELECT * FROM users WHERE id=? AND type=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$id,$type]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($arr): bool
    {

//        var_dump($arr);
//        exit();
        $fname = $arr['first_name'];
        $lname = $arr['last_name'];
        $email = $arr['email'];
        $mobile = $arr['mobile'];
        $id = $arr['id'];

        $sql = "UPDATE users SET first_name=?,last_name=?, email=?, mobile=? WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$fname, $lname, $email, $mobile, $id]);

    }

    public static function enroll($arr): bool
    {

        $course_id = $arr['course'];
        $session = $arr['session'];
        $fees = $arr['fees'];
        $joining = $arr['joining'];
        $user_id = $arr['userId'];
        $enroll_no = Student::generateEnrollmentNo($course_id);

        $sql = "INSERT INTO student_info(course_id,session,total_fees,joining,user_id,enroll_no) VALUES (?,?,?,?,?,?)";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$course_id,$session,$fees,$joining,$user_id,$enroll_no]);

    }


    public static function generateEnrollmentNo($cid): string
    {

        $ins = 'AI';
        $fy = FY::current()->code;  // financial year
        $cc = Group::getCC($cid);   // course code


        $nos = Group::studentInCourse($cid, $fy);   // no of students

        //The next number will be
        $next = $nos+1;

        // Counting No of digits
        //$num = 1235778995544444444;
        $digits = $next !== 0 ? floor(log10($next) + 1) : 1;

        if($digits == 1){
            $roll = '00'.$next;
        }elseif($digits == 2){
            $roll = '0'.$next;
        }else{
            $roll = $next;
        }

        return $ins.$fy.$cc.$roll;

    }

    public static function getAllEnrolls($id)
    {
        $sql = "SELECT si.*, groups.name, groups.short FROM student_info AS si
                LEFT JOIN groups ON groups.id=si.course_id 
                WHERE user_id=? ";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }


}