<?php

namespace App\Controller;

class IndexController
{
    public function home(): string
    {

        $viewPath = __DIR__ . '/../views/includes/Home.php';
        $title = "Accueil";
        $style = "home.css";
        $currentPage = "home";

        if (file_exists($viewPath)) {
            ob_start();
            $content = file_get_contents($viewPath);
            include __DIR__ . '/../views/layout.php';
            return ob_get_clean();
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
