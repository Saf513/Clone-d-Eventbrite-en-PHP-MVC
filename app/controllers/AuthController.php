<?php

namespace App\Controllers;

use Core\Controller;

use \App\Models\User;
use \App\Models\Member;
use \App\Models\Founder;



class AuthController extends Controller
{


     public function login()
     {
          $errors = [];

          if ($_SERVER['REQUEST_METHOD'] != "POST") {

               $this->view('Auth/login');

               return;
          }

          // Validate inputs
          $email = $_POST["email"] ?? null;
          $password = $_POST["password"] ?? null;

          if (empty($email) || empty($password)) {
               $errors[] = "All fields are required.";
               return $this->view("home/login", ["errors" => $errors]);
          }
          // Check if email already exists and return to register page

          $user = User::findByEmail($email);
          if (!$user) {
               $errors[] = "This email does not exist. Please register.";
               return $this->view("home/register", ["errors" => $errors]);
          }
          $user = new User($user["id"], $user["email"], $user["username"], $user["password"], $user["role"]);
          // Verify password
          if (!password_verify($password, $user->getPassword())) {
               $errors[] = "Invalid password.";
               return $this->view("home/login", ["errors" => $errors]);
          }

          // Store session
          $_SESSION["user_id"] = $user->getId();
          $_SESSION["user_email"] = $user->getEmail();
          $_SESSION["user_role"] = $user->getRole();

          // Redirect after successful login
          header("Location: /admin/dashboard");
          exit;
     }

     public function register()
     {
          $this->view('Auth/register');

     }

     public function handleRegister()
     {

          $errors = [];
          $success = [];

          // Validate inputs
          $full_name = $_POST["full_name"] ?? null;
          $email = $_POST["email"] ?? null;
          $password = $_POST["password"] ?? null;
          $account_type = $_POST["account_type"] ?? null;

          if (empty($email) | empty($full_name) | empty($password) | empty($account_type)) {
               $errors[] = "All fields are required.";
          }

          // check if email aleardy exists

          // Check if email already exists and return to register page
          if (User::findByEmail($email)) {
               $errors[] = "Email already exists.";
               $this->view("Auth/register", ["errors" => $errors]);
          }



          $hashed_password = password_hash($password, PASSWORD_BCRYPT);

          if ($account_type == "founder") {
               $bio = $_POST["bio"] ?? null;
               $user = new Founder(null, $full_name, $email, $hashed_password, $bio);
          } else {
               $phone_number = $_POST["phone"] ?? null;
               $address = $_POST["address"] ?? null;
               $user = new Member(null, $full_name, $email, $hashed_password, $phone_number, $address);
          }

          if ($user->register()) {
               $success[] = "User Created Successfully";
          }
          // Store user session
          $_SESSION["user_id"] = $user->getId();
          $_SESSION["user_email"] = $user->getEmail();
          $_SESSION["user_role"] = $user->getRole();
          // Redirect after successful registration

          header("Location: /");
          exit;
     }
}
