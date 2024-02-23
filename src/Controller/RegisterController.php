<?php

namespace App\Controller;

use App\Models\RegisterModel;

class RegisterController
{
    public function register()
    {
        $viewPath = __DIR__ . '/../views/includes/Register.php';
        $title = "Inscription";
        $style = "register.css";

        if (file_exists($viewPath)) {
            ob_start();
            include $viewPath;
            $content = ob_get_clean();
            include __DIR__ . '/../views/layout.php';
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
        $registerModel = new RegisterModel();

        if (isset($token['token'])) {
            $registerModel->process_verify_email($token['token']);

            $viewPath = __DIR__ . '/../views/includes/verification.php';
            $title = "Vérification";
            $style = "register.css";

            if (file_exists($viewPath)) {
                ob_start();
                include $viewPath;
                $content = ob_get_clean();
                include __DIR__ . '/../views/layout.php';
            } else {
                return "Erreur: Vue introuvable";
            }
        } else {
            $_SESSION['status'] = "Not Allowed";
            header("Location /register");
        }
    }
}
