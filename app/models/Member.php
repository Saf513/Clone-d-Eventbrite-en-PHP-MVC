<?php


namespace APP\Models;

class Member extends User
{

     protected $phone_number;
     protected $address;

     protected static string $table = 'member'; // Define table name

     function __construct($id, $username, $email, $password, $phone_number, $address)
     {

        parent::__construct($id, $username, $email, $password);

        $this -> phone_number = $phone_number;
        $this -> address = $address;
        $this -> role = "participant";
     }

     
    // getters
    function getPhoneNumber()
    {
        return $this->phone_number;
    }
    function getAddress()
    {
        return $this->address;
    }
 
    // setters 
    function setPhoneNumber(string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }
    function setAddress(string $address): void
    {

        $this->address = $address;
    }

    function register(): bool
     {
          $sql = "INSERT INTO " . self::$table . " (full_name, email, password, role, address, phone_number, created_at) VALUES (:username, :email, :password, :role, :address, :phone, NOW())";
          $stmt = self::db()->prepare($sql);
          $success = $stmt->execute([
               ':username' => $this->username,
               ':email' => $this->email,
               ':password' => $this->password,
               ':address' => $this->address,
               ':phone' => $this->phone_number,
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
          $sql = "UPDATE " . self::$table . " SET full_name = :name, email = :email, address = :address, phone_number = :phone WHERE id = :id";
          $stmt = self::db()->prepare($sql);
          return $stmt->execute([
               ':id' => $this->id,
               ':name' => $this->username,
               ':email' => $this->email,
               ':address' => $this->address,
               ':phone' => $this->phone_number
          ]);
     }
}
