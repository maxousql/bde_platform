<?php

namespace App\Controller;

class IndexController
{
    public function home()
    {

        $viewPath = __DIR__ . '/../views/includes/Home.php';
        $title = "Accueil";
        $style = "home.css";
        $currentPage = "home";

        if (file_exists($viewPath)) {
            ob_start();
            include $viewPath;
            $content = ob_get_clean();
            include __DIR__ . '/../views/layout.php';
        } else {
            return "Erreur: Vue introuvable";
        }
    }

    public function events()
    {
        $title = "Events";
        ob_start();
        include '../views/Events.php';
        $content = ob_get_clean();

        include '../views/includes/layout.php';
    }
}
