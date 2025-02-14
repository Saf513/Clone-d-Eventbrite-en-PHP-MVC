<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
{
    $currentUserId = $_SESSION['user_id'] ?? null;
    $user = User::findById($currentUserId);

    if (!$user) {
        die("User not found.");
    }

    $this->view('profile/index', ['user' => $user]);
}


    private function getPostValue($key)
    {
        return $_POST[$key] ?? null;
    }

    public function update()
    {
        $this->view('profile/update');
    }

    public function handleUpdate()
    {
        // Validate inputs
        $username = $this->getPostValue("username");
        $email = $this->getPostValue("email");
        $password = $this->getPostValue("password");
        $avatar = $this->getPostValue("avatar");


        // check if all fields are filled
        if (trim($username) === '' || trim($email) === '' || trim($password) === '' || trim($avatar) === '') {
            $errors[] = "All fields are required.";
            return $this->view("profile/update", ["errors" => $errors]);
        }


        // check email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
            return $this->view("profile/update", ["errors" => $errors]);
        }


        $currentUserId = $_SESSION['user_id'] ?? null;
        $user = User::findByEmail($email);
        if ($user && $user->id !== $currentUserId) {
            $errors[] = "This email already exists.";
            return $this->view("profile/update", ["errors" => $errors]);
        }

        $user = User::findById($currentUserId);
        if ($user) {
            $user->username = $username;
            $user->email = $email;
            $user->password = $password;
            if ($user->save()) {
                header("Location: /profile?success=Profile+updated+successfully");
                exit;
            } else {
                $errors[] = "Failed to update profile.";
                return $this->view("profile/update", ["errors" => $errors]);
            }
        } else {
            $errors[] = "User not found.";
            return $this->view("profile/update", ["errors" => $errors]);
        }
    }
}