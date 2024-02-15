<?php

namespace App\Controllers;

use App\Repositories\QuestionsRepository;
use App\Repositories\RepositoryInterface;
use App\Repositories\VoteRepository;

use eftec\bladeone\BladeOne;

class HomeController extends BaseController
{
    private RepositoryInterface $repository;
    private VoteRepository $voteRepository;

    public function __construct(BladeOne $blade)
    {
        parent::__construct($blade);
        $this->repository = new QuestionsRepository();
        $this->voteRepository = new VoteRepository();
    }

    public function index(): void
    {
        $questions = $this->repository->findAll();
        try {
            echo $this->blade->run('home', ['questions' => $questions]);
        } catch (\Exception $e) {
            echo "$e";
        }
    }

    public function vote(): void
    {
        $vote = $_POST['vote'];
        $questionId = $_POST['question_id'];

        if($vote === 'up'){
            $this->voteRepository->upvote($questionId);
        } elseif ($vote === 'down'){
            $this->voteRepository->downvote($questionId);
        }
        header("Location: /");
    }

}