<?php

namespace App\Controllers;

use Core\Controller;


class DashboardController extends Controller
{
     public function index()
     {

          if ($_SESSION['user_role'] == 'participant') {
               $this->view('Dashboard/member');
          }
          
     }
 
}
