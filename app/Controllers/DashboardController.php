<?php

namespace App\Controllers;

use App\Repositories\QuestionsRepository;
use App\Repositories\RepositoryInterface;
use eftec\bladeone\BladeOne;

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
        echo $this->blade->run('dashboard');
    }

    public function saveQuestion(): void
    {
        $entity = ['image_id' => $_POST['image_id'], 'user_id' => $_SESSION['user_id'], 'title' => $_POST['title'], 'message' => $_POST['message']];
        $this->repository->save($entity);
    }
}