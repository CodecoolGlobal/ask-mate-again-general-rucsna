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


}