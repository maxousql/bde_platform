<?php

namespace App\Controller;

class LoginController
{
    public function login(): string
    {

        $viewPath = __DIR__ . '/../views/includes/Login.php';
        $title = "Connexion";
        $style = "login.css";

        if (file_exists($viewPath)) {
            ob_start();
            $content = file_get_contents($viewPath);
            include __DIR__ . '/../views/layout.php';
            return ob_get_clean();
        } else {
            return "Erreur: Vue introuvable";
        }
    }

    public function traitement_login()
    {
        if (isset($_POST['valid_login'])) {
            extract($_POST);
        }
    }
}
