<?php

namespace App\Controller;

class ProfileController
{
    public function profile()
    {
        $viewPath = __DIR__ . '/../views/includes/Profile.php';
        $title = "Profile";
        $style = "profile.css";
        $currentPage = "profile";

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