<?php


namespace APP\Models;

class Admin extends User
{

     protected static string $table = 'admins'; // Define table name

     function __construct($id, $username, $email, $password)
     {

        parent::__construct($id, $username, $email, $password);

        $this -> role = "admin";

     }

    
}
