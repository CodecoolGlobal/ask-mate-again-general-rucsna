<?php

namespace App\Controllers;

use App\Repositories\QuestionsRepository;
use App\Repositories\RepositoryInterface;
use eftec\bladeone\BladeOne;

class HomeController extends BaseController
{
    private RepositoryInterface $repository;

    public function __construct(BladeOne $blade)
    {
        parent::__construct($blade);
        $this->repository = new QuestionsRepository();
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
}