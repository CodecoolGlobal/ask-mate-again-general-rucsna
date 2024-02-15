<?php

namespace App\Repositories;

use App\Database;
use PDO;

class ImageRepository

{
    private PDO $PDO;
    public function __construct(){

    $this->PDO = Database::getInstance()->getConnection();

    }

    public function saveImage($entity): int
    {
        $sql = 'INSERT INTO image(directory, file_name) VALUES(:directory, :file_name)';
        $insertNewQuestion = $this->PDO->prepare($sql);
        $insertNewQuestion->execute(['directory' => $entity['directory'], 'file_name' => $entity['file_name']]);

        return $this->PDO->lastInsertId();
    }
}