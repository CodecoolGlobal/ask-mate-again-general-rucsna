<?php

namespace App\Controllers;


use App\Repositories\QuestionsRepository;
use App\Repositories\RepositoryInterface;
use eftec\bladeone\BladeOne;
use Exception;

class DashboardController extends BaseController
{
    private RepositoryInterface $repository;
    public function __construct(BladeOne $blade)
    {
        parent::__construct($blade);
        $this->repository = new QuestionsRepository();
    }

    public function index(): void
    {
        session_start();
        if(isset($_SESSION['user_id'])){
            $questions = $this->repository->findQuestionsByUser($_SESSION['user_id']);
            try {
                echo $this->blade->run('dashboard', ['questions' => $questions]);
            } catch (Exception $e) {
                echo "$e";
            }
        } else {
            echo $this->blade->run('dashboard');
        }
    }
}