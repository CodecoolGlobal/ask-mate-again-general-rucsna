<?php

namespace App\Repositories;

use app\Database;
use PDO;

class QuestionsRepository implements RepositoryInterface
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = Database::connect();
    }

    public function findAll(): array
    {
        $sql = 'SELECT * FROM question';
        $selectAll = $this->PDO->query($sql);

        $questions = [];
        while ($row = $selectAll->fetch()){
            $questions[] = $row;
        }
        return $questions;
    }

    public function find(int $id)
    {
        // TODO: Implement find() method.
    }

    public function save($entity): int
    {
        $sql = 'INSERT INTO question(id_image, id_registered_user, title, message) VALUES(:id_image, :id_registered_user, :title, :message)';
        $insertNewQuestion = $this->PDO->prepare($sql);
        $insertNewQuestion->execute(['image_id' => $entity['image_id'], 'id_registered_user' => $entity['id_registered_user'], 'title' => $entity['title'], 'message' => $entity['message']]);

        $id = $this->PDO->lastInsertId();
        echo "Question $id added";
        return $id;
    }

    public function update($entity): void
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): void
    {
        // TODO: Implement delete() method.
    }
}