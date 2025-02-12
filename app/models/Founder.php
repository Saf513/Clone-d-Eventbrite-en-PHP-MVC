<?php


namespace APP\Models;

class Founder extends User
{

     protected $bio;

     protected static string $table = 'founder'; // Define table name

     function __construct($id, $username, $email, $password, $bio)
     {

        parent::__construct($id, $username, $email, $password);

        $this -> bio = $bio;
        $this -> role = "organizer";

     }

     
    // getters
    function getBio()
    {
        return $this->bio;
    }
 
    // setters 
    function setBio(string $bio): void
    {
        $this->bio = $bio;
    }


     public function register(): bool
     {
          $sql = "INSERT INTO " . self::$table . " (full_name, email, password, role, bio, created_at) VALUES (:username, :email, :password, :role, :bio, NOW())";
          $stmt = self::db()->prepare($sql);
          $success = $stmt->execute([
               ':username' => $this->username,
               ':email' => $this->email,
               ':password' => $this->password,
               ':bio' => $this->bio,
               ':role' => $this->role

          ]);

          if ($success) {
               $this->id = (int)self::db()->lastInsertId();
               return true;
          }

          return false;
     }

     public function update(): bool
     {
          $sql = "UPDATE " . self::$table . " SET full_name = :name, email = :email, bio = :bio WHERE id = :id";
          $stmt = self::db()->prepare($sql);
          return $stmt->execute([
               ':id' => $this->id,
               ':name' => $this->username,
               ':email' => $this->email,
               ':bio' => $this->bio
          ]);
     }

}
