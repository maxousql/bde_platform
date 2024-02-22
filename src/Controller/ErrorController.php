<?php

namespace App\Controller;

class ErrorController
{
    public function error401()
    {
        $viewPath = __DIR__ . '/../views/includes/Error401.php';
        $title = "Erreur 401";
        $style = "error401.css";
        $currentPage = "error";

        if (file_exists($viewPath)) {
            ob_start();
            include $viewPath;
            $content = ob_get_clean();
            include __DIR__ . '/../views/layout.php';
        } else {
            return "Erreur: Vue introuvable";
        }
    }

    public function error403()
    {
        $viewPath = __DIR__ . '/../views/includes/Error403.php';
        $title = "Erreur 403";
        $style = "error403.css";
        $currentPage = "error";

        if (file_exists($viewPath)) {
            ob_start();
            include $viewPath;
            $content = ob_get_clean();
            include __DIR__ . '/../views/layout.php';
        } else {
            return "Erreur: Vue introuvable";
        }
    }
}
