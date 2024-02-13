<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index(): void
    {
        echo $this->blade->run('dashboard');
    }
}