<?php

namespace App\Repositories;

use App\Database;
use PDO;

class AnswerRepository implements RepositoryInterface
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = Database::getInstance()->getConnection();
    }

    public function findAll(): array
    {
        $sql = 'SELECT * FROM answer';
        $selectAll = $this->PDO->query($sql);

        $answers = [];
        while ($row = $selectAll->fetch(PDO::FETCH_ASSOC)){
            $answers[] = $row;
        }
        return $answers;
    }

    public function find(int $id): bool|array
    {
        $sql = 'SELECT * FROM answer WHERE id_question = :id';
        $selectAnswerById = $this->PDO->prepare($sql);
        $selectAnswerById->execute(['id' => $id]);

        return $selectAnswerById->fetchAll();
    }

    public function save($entity): int
    {
        $sql = 'INSERT INTO answer(id_question, id_registered_user, message) VALUES(:id_question, :id_registered_user, :message)';
        $insertNewAnswer = $this->PDO->prepare($sql);
        $insertNewAnswer->execute(['id_question' => $entity['question_id'], 'id_registered_user' => $entity['user_id'], 'message' => $entity['message']]);

        return $this->PDO->lastInsertId();
    }

    public function update($entity): void
    {
        $sql = 'UPDATE answer SET message = :message WHERE id = :id';
        $updateAnswer = $this->PDO->prepare($sql);
        $updateAnswer->execute(['message' => $entity['message'], 'id' => $entity['id']]);
    }

    public function delete(int $id): void
    {
        $sql = 'DELETE FROM answer WHERE id = :id';
        $deleteAnswer = $this->PDO->prepare($sql);
        $deleteAnswer->execute(['id' => $id]);
    }
}