<?php

namespace App\Controller;

use App\Models\NotifMailModel;

class NotifMailController
{
    public function notif_j1()
    {
        if ($_SESSION['role'] === 0) {
            header("Location: /error403");
            exit;
        }
        $sendEmailJ1 = new NotifMailModel();

        $sendEmailJ1->sendemail_j1();
    }
}