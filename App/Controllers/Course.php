<?php

namespace App\Controllers;

use App\Models\Group;
use Core\Controller;
use Core\View;

class Course extends Controller
{

    public function indexAction(){

        $groups = Group::fetchAll();

        //View::renderBlade('/course/index',['groups'=>$groups]);
        View::renderBlade('/course/w3index2',['groups'=>$groups]);
    }

    /**
     * Render text content
     *
     * @return void
     */
    public function detailsAction(){

        $course_id = $_GET['cid'];
        if(empty($course_id)){
            $this->redirect('/home/page-not-found');
        }
        $content = Group::fetch($course_id);
//        View::renderBlade('course.details',['content'=>$content]);
        View::renderBlade('course.single_course',['content'=>$content]);

    }

}