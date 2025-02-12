<?php

namespace App\Models ;

use Core\Model;
use PDO;

class Admin extends User
{



    public function validateEvent(int $eventId): bool
    {
        $sql = "UPDATE events SET status = 'validated' WHERE event_id = :event_id";
        $stmt = self::db()->prepare($sql);
        return $stmt->execute([':event_id' => $eventId]);
    }

    /**
     * Bannir un utilisateur
     */
    public function banUser(int $userId): bool
    {
        $sql = "UPDATE users SET role = 'banned' WHERE user_id = :user_id";
        $stmt = self::db()->prepare($sql);
        return $stmt->execute([':user_id' => $userId]);
    }

    /**
     * Supprimer un événement
     */
    public function deleteEvent(int $eventId): bool
    {
        $sql = "DELETE FROM events WHERE event_id = :event_id";
        $stmt = self::db()->prepare($sql);
        return $stmt->execute([':event_id' => $eventId]);
    }

    /**
     * Valider un fondateur
     */
    public function validateFounder(int $userId): bool
    {
        $sql = "UPDATE users SET role = 'founder' WHERE user_id = :user_id";
        $stmt = self::db()->prepare($sql);
        return $stmt->execute([':user_id' => $userId]);
    }

    /**
     * Consulter les statistiques
     */
    public function viewStatistics(): array
    {
        $sql = "SELECT COUNT(*) as total_events, 
                       (SELECT COUNT(*) FROM users WHERE role = 'member') as total_members,
                       (SELECT COUNT(*) FROM users WHERE role = 'admin') as total_admins
                FROM events";
        $stmt = self::db()->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
