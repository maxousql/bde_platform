<?php

namespace App\Controller;

class LoginController
{
    public function login(): string
    {
        $viewPath = __DIR__ . '/../views/Login.php';

        if (file_exists($viewPath)) {
            $content = file_get_contents($viewPath);

            return $content;
        } else {
            return "Erreur: Vue introuvable";
        }
    }
}
