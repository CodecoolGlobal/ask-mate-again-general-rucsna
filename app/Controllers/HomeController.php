<?php

namespace app\Controllers;

class HomeController
{
    public function index()
    {
        echo $GLOBALS['blade']->run('home');
    }
}