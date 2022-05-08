<?php

namespace App\Controllers;


use App\Auth;
use App\Flash;
use App\Lib\Helpers;
use App\Mail;
use App\Models\Content;
use App\Models\Enroll;
use App\Models\File;
use App\Models\Group;
use App\Models\Notice;
use App\Models\Order;
use App\Models\Student;
use App\Models\Subject;
use App\Models\UserGroup;
use Core\Controller;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        //View::renderBlade('home/index');

        $groups = Group::fetchAll();
        View::renderBlade('home/w3index',['groups'=>$groups]);
    }

    /**
     * Show error page not found page
     *
     * @return void
     */
    public function pageNotFoundAction()
    {
        View::renderBlade('404');
    }

    /**
     * Show error unauthorized access page
     *
     * @return void
     */
    public function unAuthorizedAccessAction()
    {
        View::renderBlade('401');
    }

    /**
     * Show internal server error page
     *
     * @return void
     */
    public function internalServerErrorAction()
    {
        View::renderBlade('500');
    }

    /**
     * Show catalog page
     *
     * @return void
     */
    public function catalogAction(){

        $notes = Group::fetchAll();
        View::renderBlade('home/catalog',['eNotes'=>$notes]);
    }

    public function sessionAction(){

        var_dump($_SESSION);
    }

    public function testAction(){

        //$info = Student::studentInCourse(5,2223);

        $info = Student::generateEnrollmentNo(2);
        var_dump($info);
    }


    /**
     * Enrollment Page
     *
     * @return void
     */
    public function enrollAction()
    {
        View::renderBlade('home.w3enroll');
    }

    /**
     * Enrollment Page
     *
     * @return void
     */
    public function enrollSuccessAction()
    {
        View::renderBlade('home.w3_enroll_success');
    }




    /**
     * Enroll Student
     *
     * @return void
     */
    public function enrollStudent(){

//        var_dump($_POST);
//        exit();

        $enroll = new Enroll($_POST);

        if($enroll->save()){

            $this->redirect('/home/success');

        }else{

            foreach($enroll->errors as $error){
                Flash::addMessage($error,'danger');
            }
            View::renderBlade('home.w3enroll',['arr'=>$_POST]);

        }
    }

    /**
     * Enrollment Page
     *
     * @return void
     */
    public function noticesAction()
    {
        $notices = Notice::fetchAll();
        View::renderBlade('home.notices',['notices'=>$notices]);
    }


}
