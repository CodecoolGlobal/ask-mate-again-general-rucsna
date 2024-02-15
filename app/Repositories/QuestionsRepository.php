<?php

namespace App\Repositories;

use App\Database;
use PDO;

class QuestionsRepository implements RepositoryInterface
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = Database::getInstance()->getConnection();
    }

    public function findAll(): array
    {
        $sql = 'SELECT * FROM question';
        $selectAll = $this->PDO->query($sql);

        $questions = [];
        while ($row = $selectAll->fetch(PDO::FETCH_ASSOC)){
            $questions[] = $row;
        }
        return $questions;
    }

    public function find(int $id): object
    {
        $sql = 'SELECT * FROM question WHERE id = :id';
        $selectQuestionById = $this->PDO->prepare($sql);
        $selectQuestionById->execute(['id' => $id]);

        return $selectQuestionById->fetch();
    }

    public function save($entity): int
    {
        $sql = 'INSERT INTO question(id_image, id_registered_user, title, message) VALUES(:id_image, :id_registered_user, :title, :message)';
        $insertNewQuestion = $this->PDO->prepare($sql);
        $insertNewQuestion->execute(['id_image' => $entity['image_id'], 'id_registered_user' => $entity['user_id'], 'title' => $entity['title'], 'message' => $entity['message']]);

        return $this->PDO->lastInsertId();
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