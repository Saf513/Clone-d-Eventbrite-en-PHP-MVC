<?php

namespace App\Controllers;

use Core\Controller;

use \App\Models\User;

class Home extends Controller
{
     public function index()
     {

          $this->view('index.php',["message"=>"hello bubu ali"]);
     }

     public function notFound()
     {

          $this->view('home/not_found');
     }
     public function notAuthorized()
     {

          $this->view('home/not_authorized');
     }
 
}
