<?php

namespace App\Controller;

use App\Models\RegisterModel;

class RegisterController
{
    public function register(): string
    {
        $viewPath = __DIR__ . '/../views/Register.php';

        if (file_exists($viewPath)) {
            $content = file_get_contents($viewPath);

            return $content;
        } else {
            return "Erreur: Vue introuvable";
        }
    }

    public function process_register()
    {
        $registerModel = new RegisterModel();

        $userData = $_POST;

        $registerModel->processRegister($userData);
    }

    public function verify_email()
    {
        $registerModel = new RegisterModel();

        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            $registerModel->processRegister($token);
        } else {
            $_SESSION['status'] = "Not Allowed";
            header("Location /register");
        }
    }
}
