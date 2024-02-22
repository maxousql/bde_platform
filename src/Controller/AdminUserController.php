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

        if (isset($_SESSION['status_add_user']) || $_SESSION['status_add_user'] === 1) {
            unset($_SESSION['status_add_user']);
            $validAdd = 1;
        } elseif (isset($_SESSION['status_add_user']) || $_SESSION['status_add_user'] === 0) {
            unset($_SESSION['status_add_user']);
            $validAdd = 2;
        }

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
        if (isset($_SESSION['status_update_user']) || $_SESSION['status_update_user'] === 1) {
            unset($_SESSION['status_update_user']);
            $validUpdate = 1;
        } elseif (isset($_SESSION['status_update_user']) || $_SESSION['status_update_user'] === 0) {
            unset($_SESSION['status_update_user']);
            $validUpdate = 2;
        }

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

    public function processUpdateUser($userData)
    {
        $userData = $_POST;

        $editUserModel = new EditUserModel();

        try {
            $editUserModel->processUpdateUser($userData);
            $idUser = $userData['id_user'];
            $_SESSION['status_update_user'] = 1;
            header("Location: /process_editUser?id_user=$idUser");
        } catch (\Throwable $th) {
            $_SESSION['status_update_user'] = 0;
        }
    }


    public function add_user()
    {
        $viewPath = __DIR__ . '/../views/includes/AddUser.php';
        $title = "Ajout d'utilisateur";
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

    public function processAddUser()
    {
        $addUserModel = new EditUserModel();

        try {
            $addUserModel->processAddUser();
            $_SESSION['status_add_user'] = 1;
            header("Location: /admin_user");
        } catch (\Throwable $th) {
            $_SESSION['status_add_user'] = 0;
        }
    }
}
