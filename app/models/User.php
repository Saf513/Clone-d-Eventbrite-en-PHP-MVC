<?php


namespace APP\Models;

use Core\Model;
use PDO;

class User extends Model
{

     protected $id;
     protected $username;
     protected $email;
     protected $password;
     protected $role;
     protected $avatar;

     protected static string $table = 'users'; // Define table name

     function __construct($id, $username, $email, $password)
     {
          if ($id != null) {
               $this->id = $id;
          }
          $this->username = $username;
          $this->email = $email;
          $this->password = $password;
     }

     
    // getters
    function getId(): ?int
    {
        return $this->id;
    }
    function getPassword()
    {
        return $this->password;
    }
    function getUsername(): string
    {
        return $this->username;
    }
    function getEmail(): string
    {
        return $this->email;
    }
    function getRole(){
        return $this->role;
    }
 
    // setters 
    function setUsername(string $username): void
    {
        $this->username = $username;
    }
    function setEmail(string $email): void
    {

        $this->email = $email;
    }

    function setRole(string $role): void
    {

        $this->email = $role;
    }

     public function save(): bool
     {
          return $this->id ? $this->update() : $this->insert();
     }

     private function insert(): bool
     {
          $sql = "INSERT INTO " . self::$table . " (username, email,password, created_at) VALUES (:username, :email,:password, NOW())";
          $stmt = self::db()->prepare($sql);
          $success = $stmt->execute([
               ':username' => $this->username,
               ':email' => $this->email,
               ':password' => $this->password

          ]);

          if ($success) {
               $this->id = (int)self::db()->lastInsertId();
               return true;
          }

          return false;
     }

     private function update(): bool
     {
          $sql = "UPDATE " . self::$table . " SET avatar = :avatar, full_name = :full_name, email = :email WHERE id = :id";
          $stmt = self::db()->prepare($sql);
          return $stmt->execute([
               ':id' => $this->id,
               ':full_name' => $this->username,
               ':email' => $this->email,
               ':avatar' => $this->avatar
          ]);
     }

     static public function findByEmail(string $email)
     {
          $sql = "SELECT * FROM " . self::$table . " WHERE email = :email";
          $stmt = self::db()->prepare($sql);
          $stmt->execute([':email' => $email]);
          $result = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;

          return $result ?: false;
     }

     static public function findById(int $id)
     {
          $sql = "SELECT * FROM " . self::$table . " WHERE id = :id";
          $stmt = self::db()->prepare($sql);
          $stmt->execute([':id' => $id]);
          $result = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;

          return $result ?: false;
     }


     static public function deleteUser($id)
     {
          $sql = "DELETE FROM " . self::$table . " WHERE id = :id";
          $stmt = self::db()->prepare($sql);
          return $stmt->execute([':id' => $id]);
     }
}
