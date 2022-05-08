<?php

namespace App\Models;

use Core\Model;
use PDO;

class Enroll extends Model
{
    /**
     * Error message
     *
     * @var array
     */
    public $errors = [];

    /**
     * User constructor.
     * @param array $data
     */
    public function __construct(array $data=[])
    {
        foreach ($data as $key => $value){
            $this->$key=$value;
        }
    }

    public function save(): bool
    {

        $this->validate();

        if(empty($this->errors)){

            $sql = 'INSERT INTO enrolls (first_name, last_name, gender, dob, email, mobile, father_name, mother_name, course_id, address)
                    VALUES (:first_name, :last_name, :gender, :dob, :email, :mobile, :father_name, :mother_name, :course, :address)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':first_name', ucfirst($this->first_name), PDO::PARAM_STR);
            $stmt->bindValue(':last_name', ucfirst($this->last_name), PDO::PARAM_STR);
            $stmt->bindValue(':gender', $this->gender, PDO::PARAM_STR);
            $stmt->bindValue(':dob', $this->dob, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':mobile', $this->mobile, PDO::PARAM_STR);
            $stmt->bindValue(':father_name', ucfirst($this->father), PDO::PARAM_STR);
            $stmt->bindValue(':mother_name', ucfirst($this->mother), PDO::PARAM_STR);
            $stmt->bindValue(':course', $this->course, PDO::PARAM_INT);
            $stmt->bindValue(':address', $this->address, PDO::PARAM_STR);

            return $stmt->execute();

        }

        return false;
    }

    /**
     * Validate User Input
     */
    private function validate(){

        if (!preg_match("/^([a-zA-Z]{3,30})/",$this->first_name)) {
            $this->errors[] = 'Please check your first name';
        }

        if (!preg_match("/^([a-zA-Z]{3,30})$/",$this->last_name)) {
            $this->errors[] = 'Please check your last name';
        }

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[] = 'Invalid email';
        }

        if (!preg_match("/^[6-9]\d{9}$/",$this->mobile)) {
            $this->errors[] = 'Invalid mobile number';
        }

//        if (!preg_match("/^([a-zA-Z]{3,100})/",$this->father)) {
//            $this->errors[] = 'Please check father\'s name';
//        }
//
//        if (!preg_match("/^([a-zA-Z]{3,100})$/",$this->mother)) {
//            $this->errors[] = 'Please check mother\'s name';
//        }


    }


    public static function liveSearch($start, $limit){

        $query = "SELECT * FROM enrolls";

        if($_POST['query'] != ''){
            $query .= '
            WHERE first_name LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
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

        $query = "SELECT * FROM enrolls";

        if($_POST['query'] != ''){
            $query .= '
            WHERE first_name LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR mobile LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            OR email LIKE "%'.str_replace('', '%', $_POST['query']).'%" 
            ';
        }


        $pdo=Model::getDB();
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();


    }


}