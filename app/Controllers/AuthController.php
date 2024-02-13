<?php

namespace App\Controllers;

use App\Database;
use JetBrains\PhpStorm\NoReturn;

class AuthController extends BaseController
{

    public function showRegistrationForm(): void
    {
        echo $this->blade->run("register");
    }

    #[NoReturn] public function register(): void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO registered_user (email, password_hash) VALUES (?, ?)");
        $stmt->execute([$email, $passwordHash]);

        header("Location: /dashboard");
        exit;
    }

    public function showLoginForm(): void
    {
        echo $this->blade->run("login");
    }

    #[NoReturn] public function login(): void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM registered_user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user->password_hash)) {
            session_start();
            $_SESSION['user_id'] = $user->id;
            $_SESSION['email'] = $user->email;
            header("Location: /dashboard");
            exit;
        } else {
            echo $this->blade->run("login", ['error' => true]);
            exit;
        }
    }

    public function logout(): void
    {
        session_start();
        session_destroy();
        header("Location: /login");
        exit;
    }
}
