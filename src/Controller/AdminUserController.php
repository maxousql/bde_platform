<?php

namespace App\Controller;

use App\Models\EditUserModel;

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
    public function edit_user($userData)
    {
        $viewPath = __DIR__ . '/../views/includes/EditUser.php';
        $title = "Modification utilisateurs";
        $style = "editUser.css";
        $currentPage = "edit_user";
        $userData = $userData;

        if (file_exists($viewPath)) {
            ob_start();
            include $viewPath;
            $content = ob_get_clean();
            include __DIR__ . '/../views/layout.php';
        } else {
            return "Erreur: Vue introuvable";
        }
    }

    public function processEditUser()
    {
        $editUserModel = new EditUserModel();

        $userData = $editUserModel->processEditUser();

        $this->edit_user($userData);
    }

    public function processUpdateUser()
    {
        $editUserModel = new EditUserModel();

        $editUserModel->processUpdateUser();
    }
}
