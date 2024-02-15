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
        $this->repository->save($entity);
//        $questions = $this->repository->findQuestionsByUser($_SESSION['user_id']);
//        try {
//            echo $this->blade->run('dashboard', ['questions' => $questions]);
//        } catch (Exception $e) {
//            echo "$e";
//        }
        header("Location: /dashboard");
        exit;
    }

    public function goToQuestionPage(): void
    {
        $questionId = $_POST['question_id'];
        $questionToUpdate = $this->repository->find($questionId);
        try {
            echo $this->blade->run('question', ['question' => $questionToUpdate]);
        } catch (Exception $e) {
            echo "$e";
        }
//        $this->repository->update($questionToUpdate);
    }

    public function updateQuestion(): void
    {

    }

    public function deleteQuestion(): void
    {
        $questionId = $_POST['question_id'];
        $this->repository->delete($questionId);
        header("Location: /dashboard");
    }
}