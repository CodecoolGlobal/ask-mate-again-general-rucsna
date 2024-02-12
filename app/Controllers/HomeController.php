<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): void
    {
        echo $this->blade->run('home');
    }
}