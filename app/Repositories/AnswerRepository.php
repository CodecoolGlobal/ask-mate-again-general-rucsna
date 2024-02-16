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
        $sql = 'UPDATE answer SET accepted = :accepted WHERE id = :id';
        $updateAnswer = $this->PDO->prepare($sql);
        $updateAnswer->execute(['accepted' => $entity['accepted'], 'id' => $entity['id']]);
    }

    public function delete(int $id): void
    {
        $sql = 'DELETE FROM answer WHERE id = :id';
        $deleteAnswer = $this->PDO->prepare($sql);
        $deleteAnswer->execute(['id' => $id]);
    }

    public function findAnswersByQuestionId(int $question_id): array
    {
        $sql = 'SELECT * FROM answer WHERE id_question = :id_question';
        $selectAnswers = $this->PDO->prepare($sql);
        $selectAnswers->execute(['id_question' => $question_id]);

        return $selectAnswers->fetchAll(PDO::FETCH_ASSOC);
    }
}