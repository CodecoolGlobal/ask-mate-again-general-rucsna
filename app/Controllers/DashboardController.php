<?php

namespace App\Controllers;


use Exception;

class DashboardController extends BaseController
{
    public function index(): void
    {
        try {
            echo $this->blade->run('dashboard');
        } catch (Exception $e) {
            echo "$e";
        }
    }
}