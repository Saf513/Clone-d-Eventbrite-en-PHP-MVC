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

        // Get additional data based on role
        $additionalData = [];
        if ($user['role'] === 'member') {
            $memberData = User::findMemberData($currentUserId);
            $additionalData = [
                'phone_number' => $memberData['phone_number'] ?? '',
                'address' => $memberData['address'] ?? ''
            ];
        } elseif ($user['role'] === 'founder') {
            $founderData = User::findFounderData($currentUserId);
            $additionalData = [
                'bio' => $founderData['bio'] ?? ''
            ];
        }

        $this->view('profile/index', [
            'user' => $user,
            'additionalData' => $additionalData
        ]);
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
        $currentUserId = $_SESSION['user_id'] ?? null;
        $user = User::findById($currentUserId);

        if (!$user) {
            die("User not found.");
        }

        $full_name = $this->getPostValue("full_name");
        
        // Update role-specific data
        if ($user['role'] === 'member') {
            $phone_number = $this->getPostValue("phone_number");
            $address = $this->getPostValue("address");
            User::updateMemberData($currentUserId, $phone_number, $address);
        } elseif ($user['role'] === 'founder') {
            $bio = $this->getPostValue("bio");
            User::updateFounderData($currentUserId, $bio);
        }

        // Update common data
        if ($user->updateFullName($full_name)) {
            header("Location: /profile?success=Profile+updated+successfully");
            exit;
        } else {
            $errors[] = "Failed to update profile.";
            return $this->view("profile/index", ["errors" => $errors]);
        }
    }
}