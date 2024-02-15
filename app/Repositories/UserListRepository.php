<?php

namespace App\Repositories;

use App\Database;
use PDO;

class UserListRepository
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = Database::getInstance()->getConnection();
    }

    public function getUsers(): array
    {
        $sql = 'SELECT u.id AS id, u.email, u.registration_time, 
               COUNT(DISTINCT q.id) AS question_count, 
               COUNT(DISTINCT a.id) AS answer_count
                FROM registered_user u
                LEFT JOIN question q ON u.id = q.id_registered_user
                LEFT JOIN answer a ON u.id = a.id_registered_user
                GROUP BY u.id, u.email, u.registration_time;
                ';

        $stmt = $this->PDO->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }
}
