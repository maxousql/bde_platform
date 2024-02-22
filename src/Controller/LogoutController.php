<?php

namespace App\Controller;

use App\Models\LogoutModel;

class LogoutController
{
    public function process_logout()
    {
        if ($_SESSION['role'] === 0) {
            header("Location: /error403");
            exit;
        }
        $logoutModel = new LogoutModel();

        $userData = $_POST;

        $logoutModel->processLogout();
    }
}
