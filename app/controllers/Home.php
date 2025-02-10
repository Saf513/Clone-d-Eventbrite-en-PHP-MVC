<?php

namespace App\Controllers;

use Core\Controller;

use \App\Models\User;

class Home extends Controller
{
     public function index()
     {

          $this->view('index',["message"=>"hello bubu ali"]);
     }
 
}
