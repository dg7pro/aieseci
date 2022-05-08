<?php

namespace App\Controllers;

use App\Models\Group;
use Core\Controller;
use Core\View;

class Contact extends Controller
{

    public function indexAction(){

        View::renderBlade('/contact/w3index');
    }

}