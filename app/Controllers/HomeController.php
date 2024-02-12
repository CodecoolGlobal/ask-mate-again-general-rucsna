<?php

namespace App\Controllers;

class HomeController
{
    public function index(): void
    {
        echo $GLOBALS['blade']->run('home');
    }
}