<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $this->view('admin/dashboard');
    }

    public function manageUsers()
    {
        $users = User::all();
        $this->view('Admin/manage_users', ['users' => $users]);
    }

    public function deleteUser($id)
    {
        if (User::delete($id)) {
            header("Location: /admin/manage-users?success=User+deleted+successfully");
        } else {
            header("Location: /admin/manage-users?error=Failed+to+delete+user");
        }
        exit;
    }

    public function editUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            header("Location: /admin/manage-users?error=User+not+found");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';

            if (empty($username) || empty($email)) {
                $errors = ['All fields are required'];
                return $this->view('Admin/edit_user', ['user' => $user, 'errors' => $errors]);
            }

            $userModel = new User($user['id'], $username, $email, $user['password']);
            if ($userModel->save()) {
                header("Location: /admin/manage-users?success=User+updated+successfully");
            } else {
                $errors = ['Failed to update user'];
                $this->view('Admin/edit_user', ['user' => $user, 'errors' => $errors]);
            }
            exit;
        }

        $this->view('Admin/edit_user', ['user' => $user]);
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($email) || empty($password)) {
                $errors = ['All fields are required'];
                return $this->view('Admin/create_user', ['errors' => $errors]);
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $user = new User(null, $username, $email, $hashedPassword);

            if ($user->save()) {
                header("Location: /admin/manage-users?success=User+created+successfully");
            } else {
                $errors = ['Failed to create user'];
                $this->view('Admin/create_user', ['errors' => $errors]);
            }
            exit;
        }

        $this->view('Admin/create_user');
    }

    public function viewUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            header("Location: /admin/manage-users?error=User+not+found");
            exit;
        }

        $this->view('Admin/view_user', ['user' => $user]);
    }

    public function promoteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            header("Location: /admin/manage-users?error=User+not+found");
            exit;
        }

        $userModel = new User($user['id'], $user['username'], $user['email'], $user['password']);
        if (method_exists($userModel, 'setRole')) {
            $userModel->setRole('admin');
            if ($userModel->save()) {
                header("Location: /admin/manage-users?success=User+promoted+to+admin");
            } else {
                header("Location: /admin/manage-users?error=Failed+to+promote+user");
            }
        } else {
            header("Location: /admin/manage-users?error=Method+setRole+not+available");
        }
        exit;
    }

    public function demoteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            header("Location: /admin/manage-users?error=User+not+found");
            exit;
        }

        $userModel = new User($user['id'], $user['username'], $user['email'], $user['password']);
        if (method_exists($userModel, 'setRole')) {
            $userModel->setRole('user');
            if ($userModel->save()) {
                header("Location: /admin/manage-users?success=User+demoted+to+regular+user");
            } else {
                header("Location: /admin/manage-users?error=Failed+to+demote+user");
            }
        } else {
            header("Location: /admin/manage-users?error=Method+setRole+not+available");
        }
        exit;
    }

    public function resetUserPassword($id)
    {
        $user = User::find($id);

        if (!$user) {
            header("Location: /admin/manage-users?error=User+not+found");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newPassword = $_POST['password'] ?? '';

            if (empty($newPassword)) {
                $errors = ['Password field is required'];
                return $this->view('Admin/reset_password', ['user' => $user, 'errors' => $errors]);
            }

            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $user['password'] = $hashedPassword;

            $userModel = new User($user['id'], $user['username'], $user['email'], $user['password']);
            if ($userModel->save()) {
                header("Location: /admin/manage-users?success=Password+reset+successfully");
            } else {
                header("Location: /admin/manage-users?error=Failed+to+reset+password");
            }
            exit;
        }

        $this->view('Admin/reset_password', ['user' => $user]);
    }
}