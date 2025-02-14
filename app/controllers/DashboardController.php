<?php

namespace App\Controllers;

use Core\Controller;

use \App\Models\Member;

class DashboardController extends Controller
{
     public function index()
     {

          if ($_SESSION['user_role'] == 'participant') {

               $member = new Member($_SESSION['user_id']);
               $stats = $member -> getStatistics();
               $events_history = $member -> getEventsHistory();

               $this->view('Dashboard/member', ['stats' => $stats, 'history' => $events_history]);
          }
          
     }
 
}
