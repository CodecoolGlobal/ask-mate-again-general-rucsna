<?php

namespace App\Controllers;

use App\Repositories\AnswerRepository;
use App\Repositories\QuestionsRepository;
use App\Repositories\TagsRepository;
use eftec\bladeone\BladeOne;
use JetBrains\PhpStorm\NoReturn;

class AnswerController extends BaseController
{
    private AnswerRepository $answerRepository;
    private QuestionsRepository $repository;
    private TagsRepository $tagsRepository;

    public function __construct(BladeOne $blade)
    {
        $this->answerRepository = new AnswerRepository();
        parent::__construct($blade);
        $this->repository = new QuestionsRepository();
        $this->tagsRepository = new TagsRepository();
    }

    public function index(): void
    {
        $questionId = $_POST['id'];
        $tags = $this->tagsRepository->displayAllTags();
        $questionTags = $this->tagsRepository->displayTags($questionId);
        $currentQuestion = $this->repository->find($questionId);
        $currentAnswers = $this->answerRepository->find($questionId);

        try {
            echo $this->blade->run('answer', ['question' => $currentQuestion, 'tags' => $tags, 'questionTags' => $questionTags, 'answers' => $currentAnswers]);
        } catch (Exception $e) {
            echo "$e";
        }
    }

    #[NoReturn] public function saveAnswer(): void
    {
        session_start();
        $entity = ['question_id' => $_POST['question_id'], 'user_id' => $_SESSION['user_id'], 'message' => $_POST['message']];
        $this->answerRepository->save($entity);
        header("Location: /");
        exit;
    }

    public function action(): void
    {
        $vote = $_POST['answer'];
        $answerId = $_POST['answer_id'];

        if($vote === 'delete'){
            $this->answerRepository->delete($answerId);
        } elseif ($vote === 'edit'){
            $entity = ['message' => $_POST['message'], 'id' => $answerId];
            $this->answerRepository->update($entity);
        }
        header("Location: /");
    }

}