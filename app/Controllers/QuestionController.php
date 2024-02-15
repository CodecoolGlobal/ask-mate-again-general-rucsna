<?php

namespace App\Controllers;

use App\Repositories\AnswerRepository;
use App\Repositories\ImageRepository;
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
    private ImageRepository $imageRepository;
    private RepositoryInterface $answerRepository;

    public function __construct(BladeOne $blade)
    {
        parent::__construct($blade);
        $this->repository = new QuestionsRepository();
        $this->tagsRepository = new TagsRepository();
        $this->imageRepository = new ImageRepository();
        $this->answerRepository = new AnswerRepository();
    }

    #[NoReturn] public function saveQuestion(): void
    {

        $uploadDir = __DIR__ . '/../../public/img/';
        $fileName = $_FILES['image'] ['name'];
        $tmp_name = $_FILES['image'] ['tmp_name'];

        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if ($fileExtension !== 'png') {
            echo "Error: Only PNG files are allowed.";
            exit;
        }

        move_uploaded_file($tmp_name,$uploadDir.$fileName);

        $image = ['directory' => 'public/img/', 'file_name' => $fileName];
        $imgId = $this->imageRepository->saveImage($image);

        session_start();
        $entity = ['image_id' => $imgId, 'user_id' => $_SESSION['user_id'], 'title' => $_POST['title'], 'message' => $_POST['message']];
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
        $answers = $this->answerRepository->findAnswersByQuestionId($questionId);

        try {
            echo $this->blade->run('question', ['question' => $currentQuestion, 'tags' => $tags, 'questionTags' => $questionTags, 'answers' => $answers]);
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

        header('Location: /dashboard');
    }

    public function deleteQuestion(): void
    {
        $questionId = $_POST['question_id'];
        $this->repository->delete($questionId);
        header("Location: /dashboard");
    }
}