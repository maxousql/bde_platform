<?php

namespace App\Models;

class LogoutModel
{
    public function processLogout()
    {
        session_unset();
        header("Location: /");
    }
}