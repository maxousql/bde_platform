<?php

namespace App\Controller;

use App\Models\LogoutModel;

class LogoutController
{
    public function process_logout()
    {
        $logoutModel = new LogoutModel();

        $userData = $_POST;

        $logoutModel->processLogout();
    }
}
