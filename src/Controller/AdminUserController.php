<?php

namespace App\Controller;

class AdminUserController
{
    public function admin_user()
    {

        $viewPath = __DIR__ . '/../views/includes/AdminUser.php';
        $title = "Gestion utilisateurs";
        $style = "adminUser.css";
        $currentPage = "admin_user";

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
