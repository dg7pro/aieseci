<?php


namespace App\Models;


use Core\Model;
use PDO;

class Group extends Model
{
    public static function fetch($gid){

        $sql = "SELECT * FROM groups WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$gid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function fetchAll(): array
    {
        $sql = "SELECT * FROM groups ORDER BY sno";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function fetchAllActive(): array
    {
        $sql = "SELECT * FROM groups";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function fetchGroupWithSubDetails($id)
    {
        $sql = "SELECT t1.name AS grp, t2.name, t2.name AS subj, t3.title FROM groups AS t1 
                JOIN subjects AS t2 ON t2.group_id=t1.id
                LEFT JOIN contents AS t3 ON t3.subject_id=t2.id
                WHERE t1.id = ?
                ";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);

        // TODO :: checking is required very important 3 level deep fetch record
    }

    public static function fetchGroupPriceList(){

        $sql = "SELECT id,name,price FROM groups";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public static function processDiscount($arr){

        $sql = "UPDATE groups SET discount_rate=?, discount_price=? WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$arr['rate'],$arr['price'],$arr['id']]);
    }

    public static function update($arr){

        $name = $arr['name'];
        $short = $arr['short'];
        $degree = $arr['degree'];
        $fees = $arr['fees'];
        $discount = $arr['discount'];
        $instalments = $arr['installment'];
        $term = $arr['term'];
        $tenure = $arr['tenure'];
        $colour = $arr['color'];
        $open = $arr['open'];
        $deactive = $arr['deactive'];
        $id = $arr['id'];

        $sql = "UPDATE groups SET name=?, short=?, degree=?, fees=?, discount=?, instalments=?, term=?, tenure=?, color=?, open=?, deactive=? WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$name,$short,$degree,$fees,$discount,$instalments,$term,$tenure,$colour,$open,$deactive,$id]);

    }

    public static function updateMatter($arr): bool
    {

        $gid = $arr['content_id'];
        $matter = $arr['matter'];

        $sql = "UPDATE groups SET matter=? WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$matter,$gid]);

    }

    public static function updateOrder($sno,$id){

        $sql = "UPDATE groups SET sno=? WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$sno,$id]);

    }


    public static function insert($arr){

        $name = $arr['name'];
        $short = $arr['short'];
        $degree = $arr['degree'];
        $fees = $arr['fees'];
        $discount = $arr['discount'];
        $instalments = $arr['instalments'];
        $term = $arr['term'];
        $tenure = $arr['tenure'];
        $color = $arr['color'];
        $open = $arr['open'];
        $deactive = $arr['deactive'];


        $sql = "INSERT INTO groups(name,short,degree,fees,discount,instalments,term,tenure,color,open,deactive) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$name,$short,$degree,$fees,$discount,$instalments,$term,$tenure,$color,$open,$deactive]);

    }

    public static function deleteRecord($id){

        $sql = "DELETE FROM groups WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        return $stmt->execute([$id]);

    }

    public static function getCC($cid){

        $sql = "SELECT micro FROM groups WHERE id=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$cid]);
        return $stmt->fetchColumn(0);
    }

    public static function studentInCourse($cid, $fy): int
    {

        $type = 'Student';
        $sql = "SELECT * FROM student_info WHERE course_id=? AND session=?";
        $pdo=Model::getDB();
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$cid, $fy]);
        //return $stmt->fetch(PDO::FETCH_ASSOC);

        return $stmt->rowCount();

    }

}