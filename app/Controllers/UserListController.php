<?php

namespace App\Controllers;

use App\Repositories\UserListRepository;
use eftec\bladeone\BladeOne;

class UserListController extends BaseController
{
    private UserListRepository $userListRepository;

    public function __construct(BladeOne $blade)
    {
        parent::__construct($blade);
        $this->userListRepository = new UserListRepository();
    }

    public function index(): void
    {
        $users = $this->userListRepository->getUsers();
        try {
            echo $this->blade->run('userlist', ['users' => $users]);
        } catch (\Exception $e) {
            echo "$e";
        }
    }

}