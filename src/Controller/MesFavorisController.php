<?php

namespace App\Controller;

class MesFavorisController
{
    public function mesfavoris()
    {
        $viewPath = __DIR__ . '/../views/includes/MesFavoris.php';
        $title = "MesFavoris";
        $style = "mesfavoris.css";
        $currentPage = "mesfavoris";

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
