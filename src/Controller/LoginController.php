<?php

namespace App\Controller;

use App\Models\LoginModel;

class LoginController
{
    public function login(): string
    {

        $viewPath = __DIR__ . '/../views/includes/Login.php';
        $title = "Connexion";
        $style = "login.css";
        $currentPage = "login";

        if (file_exists($viewPath)) {
            ob_start();
            $content = file_get_contents($viewPath);
            include __DIR__ . '/../views/layout.php';
            return ob_get_clean();
        } else {
            return "Erreur: Vue introuvable";
        }
    }

    public function process_login()
    {
        $loginModel = new LoginModel();

        $userData = $_POST;

        $loginModel->processLogin($userData);
    }
}
