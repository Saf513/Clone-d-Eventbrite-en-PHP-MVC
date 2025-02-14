<?php


namespace APP\Models;

use \App\Models\User;

class Member extends User
{

     protected $phone_number;
     protected $address;

     protected static string $table = 'member'; // Define table name

     function __construct($id = 0, $username = "", $email = "", $password = "", $phone_number = "", $address = "")
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

     public function getStatistics() {
          // SELECT count(*) as count FROM tickets WHERE member_id = :id                                 
          // UNION ALL SELECT count(*) as count FROM tickets join events on events.event_id = tickets.event_id WHERE member_id = :id and date > NOW()            
          // UNION ALL SELECT count(*) as count FROM payments WHERE user_id = :id and payment_status = 'Annulé'
          // UNION ALL SELECT SUM(amount) as count FROM payments WHERE user_id = :id
          // UNION ALL SELECT C.name, count(E.category_id) as count FROM events E JOIN categories C on E.category_id = C.category_id join tickets T on T.event_id = E.event_id WHERE member_id = :id GROUP BY C.name ORDER BY count DESC LIMIT 1
          
          $SQL = "SELECT count(*) as total_events,
          count(CASE WHEN date > NOW() THEN 1 END) as coming_events,
          count(CASE WHEN payment_status = 'Annulé' THEN 1 END) as canceled_events,
          SUM(amount) as total_amount
          from tickets T 
          join events E on T.event_id = E.event_id 
          join categories C on C.category_id = E.category_id
          left join payments P on P.ticket_id = T.ticket_id
          WHERE member_id = :id";

          $stmt = self::db() -> prepare($SQL);
          $stmt->execute([':id' => $_SESSION['user_id']]);

          return $stmt -> fetchAll();
     }

     public function getEventsHistory() {
          $SQL = "SELECT E.*, 
                    C.name as category_name,
               CASE
                    WHEN date < NOW() 
                    THEN 'Completed'
                    ELSE 'Pending'
               END AS event_status
               FROM events E 
               join tickets T on E.event_id = T.event_id
               join categories C on C.category_id = E.category_id
               WHERE member_id = :id";

          

          $stmt = self::db() -> prepare($SQL);
          $stmt->execute([':id' => $_SESSION['user_id']]);

          return $stmt -> fetchAll();
     }
}
