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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query'])) {
            $searchQuery = $_POST['query'];
            $questions = $this->repository->searchQuestions($searchQuery);
        } else {
            $questions = $this->repository->findWithImage();
        }

        try {
            echo $this->blade->run('home', ['questions' => $questions]);
        } catch (\Exception $e) {
            echo "$e";
        }
    }

    public function search(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query'])) {
            $searchQuery = $_POST['query'];
            $questions = $this->repository->findWithImage();

            $filteredQuestions = array_filter($questions, function($question) use ($searchQuery) {
                return stripos($question['title'], $searchQuery) !== false ||
                    stripos($question['message'], $searchQuery) !== false;
            });
        } else {
            $filteredQuestions = $this->repository->findWithImage();
        }

        try {
            echo $this->blade->run('home', ['questions' => $filteredQuestions]);
        } catch (\Exception $e) {
            echo "$e";
        }
    }


    public function vote(): void
    {
        $vote = $_POST['vote'];
        $Id = $_POST['id'];

        if($vote === 'up'){
            $this->voteRepository->upvote($Id);
        } elseif ($vote === 'down'){
            $this->voteRepository->downvote($Id);
        } elseif ($vote === 'downAnswer'){
            $this->voteRepository->downvoteAnswer($Id);
        } elseif ($vote === 'upAnswer'){
            $this->voteRepository->upvoteAnswer($Id);
        }

        header("Location: /");
    }

}