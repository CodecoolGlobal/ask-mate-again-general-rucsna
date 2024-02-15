<?php

namespace App\Controllers;

use App\Repositories\QuestionsRepository;
use App\Repositories\RepositoryInterface;
use App\Repositories\TagsRepository;
use eftec\bladeone\BladeOne;
use Exception;
use JetBrains\PhpStorm\NoReturn;

class QuestionController extends BaseController
{
    private RepositoryInterface $repository;

    public function __construct(BladeOne $blade)
    {
        parent::__construct($blade);
        $this->repository = new QuestionsRepository();
    }

    #[NoReturn] public function saveQuestion(): void
    {
        session_start();
        $entity = ['image_id' => $_POST['image_id'], 'user_id' => $_SESSION['user_id'], 'title' => $_POST['title'], 'message' => $_POST['message']];
        $this->repository->save($entity);
        header("Location: /dashboard");
        exit;
    }

    public function goToQuestionPage(): void
    {
        $questionId = $_POST['question_id'];
        $tagRepo = new TagsRepository();
        $tags = $tagRepo->displayAllTags();
        $currentQuestion = $this->repository->find($questionId);

        try {
            echo $this->blade->run('question', ['question' => $currentQuestion, 'tags' => $tags]);
        } catch (Exception $e) {
            echo "$e";
        }
    }

    public function updateQuestion(): void
    {
        $questionToUpdate = array(
            'id' => $_POST['question_id'],
            'title' => $_POST['title'],
            'message' => $_POST['message']
        );
        //var_dump($questionToUpdate);
        $this->repository->update($questionToUpdate);
        header('Location: /dashboard');
    }

    public function deleteQuestion(): void
    {
        $questionId = $_POST['question_id'];
        $this->repository->delete($questionId);
        header("Location: /dashboard");
    }
}