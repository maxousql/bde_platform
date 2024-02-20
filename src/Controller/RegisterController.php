<?php

namespace App\Controller;

use App\Models\RegisterModel;

class RegisterController
{
    public function register(): string
    {

        $viewPath = __DIR__ . '/../views/includes/Register.php';
        $title = "Inscription";
        $style = "register.css";

        if (file_exists($viewPath)) {
            ob_start();
            $content = file_get_contents($viewPath);
            include __DIR__ . '/../views/layout.php';
            return ob_get_clean();
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

    public function verify_email($token)
    {
        var_dump($token);
        $registerModel = new RegisterModel();

        if (isset($token)) {
            $registerModel->processRegister($token);
        } else {
            $_SESSION['status'] = "Not Allowed";
            header("Location /register");
        }
    }
}
