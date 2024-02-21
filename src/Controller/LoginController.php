<?php

namespace App\Controller;

use App\Models\LoginModel;

class LoginController
{
    public function login()
    {

        $viewPath = __DIR__ . '/../views/includes/Login.php';
        $title = "Connexion";
        $style = "login.css";
        $currentPage = "login";

        if (file_exists($viewPath)) {
            ob_start();
            include $viewPath;
            $content = ob_get_clean();
            include __DIR__ . '/../views/layout.php';
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
