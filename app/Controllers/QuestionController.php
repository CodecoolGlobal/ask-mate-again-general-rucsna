<?php

namespace App\Controllers;

use App\Repositories\QuestionsRepository;
use App\Repositories\RepositoryInterface;
use App\Repositories\TagsRepository;
use eftec\bladeone\BladeOne;
use Exception;

class QuestionController extends BaseController
{
    private RepositoryInterface $repository;

    public function __construct(BladeOne $blade)
    {
        parent::__construct($blade);
        $this->repository = new QuestionsRepository();
    }

    public function saveQuestion(): void
    {
        session_start();
        $entity = ['image_id' => $_POST['image_id'], 'user_id' => $_SESSION['user_id'], 'title' => $_POST['title'], 'message' => $_POST['message']];
        $questionId = $this->repository->save($entity);
        $question = $this->repository->find($questionId);
        try {
            echo $this->blade->run('question', ['question' => $question]);
        } catch (Exception $e) {
            echo "$e";
        }
    }

//    public function displayQuestionById(): void
//    {
//        $question = $this->repository->find()
//    }
}