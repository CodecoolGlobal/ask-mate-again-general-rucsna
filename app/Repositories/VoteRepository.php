<?php

namespace App\Repositories;

use App\Database;
use PDO;

class VoteRepository
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = Database::getInstance()->getConnection();
    }

    private function getVoteNumber(int $questionId): int
    {
        $sql = 'SELECT vote_number FROM question WHERE id = ?';
        $selectVoteById = $this->PDO->prepare($sql);
        $selectVoteById->execute([$questionId]);

        return $selectVoteById->fetchColumn();
    }

    private function getAnswerVoteNumber(int $Id): int
    {
        $sql = 'SELECT vote_number FROM answer WHERE id = ?';
        $selectVoteById = $this->PDO->prepare($sql);
        $selectVoteById->execute([$Id]);

        return $selectVoteById->fetchColumn();
    }

    public function upvote($questionId): void
    {
        $currentVoteNumber = $this->getVoteNumber($questionId);
        $newVoteNumber = $currentVoteNumber + 1;

        $sql = 'UPDATE question SET vote_number = ? WHERE id = ?';
        $upvoteById = $this->PDO->prepare($sql);
        $upvoteById->execute([$newVoteNumber, $questionId]);
    }

    public function downvote($questionId): void
    {
        $currentVoteNumber = $this->getVoteNumber($questionId);
        $newVoteNumber = $currentVoteNumber - 1;

        $sql = 'UPDATE question SET vote_number = ? WHERE id = ?';
        $downvoteById = $this->PDO->prepare($sql);
        $downvoteById->execute([$newVoteNumber, $questionId]);
    }

    public function downvoteAnswer(mixed $Id)
    {
        $currentVoteNumber = $this->getAnswerVoteNumber($Id);
        $newVoteNumber = $currentVoteNumber - 1;

        $sql = 'UPDATE answer SET vote_number = ? WHERE id = ?';
        $downvoteById = $this->PDO->prepare($sql);
        $downvoteById->execute([$newVoteNumber, $Id]);
    }

    public function upvoteAnswer(mixed $Id)
    {
        $currentVoteNumber = $this->getAnswerVoteNumber($Id);
        $newVoteNumber = $currentVoteNumber + 1;

        $sql = 'UPDATE answer SET vote_number = ? WHERE id = ?';
        $upvoteById = $this->PDO->prepare($sql);
        $upvoteById->execute([$newVoteNumber, $Id]);
    }


}