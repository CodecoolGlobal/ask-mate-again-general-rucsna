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
    private TagsRepository $tagsRepository;

    public function __construct(BladeOne $blade)
    {
        parent::__construct($blade);
        $this->repository = new QuestionsRepository();
        $this->tagsRepository = new TagsRepository();
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
        $tags = $this->tagsRepository->displayAllTags();
        $questionTags = $this->tagsRepository->displayTags($questionId);
        $currentQuestion = $this->repository->find($questionId);

        try {
            echo $this->blade->run('question', ['question' => $currentQuestion, 'tags' => $tags, 'questionTags' => $questionTags]);
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

        $this->tagsRepository->addTagToQuestion($_POST['question_id'], $_POST['tag_id']);

        header("Location: /dashboard");
    }

    public function deleteQuestion(): void
    {
        $questionId = $_POST['question_id'];
        $this->repository->delete($questionId);
        header("Location: /dashboard");
    }
}