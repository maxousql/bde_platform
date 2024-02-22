<?php

namespace App\Controller;

use App\Models\UpdateEventModel;

class AdminEventController
{
    public function process_deleteEvent()
    {
        if ($_SESSION['role'] != 2) {
            header("Location: /error403");
            exit;
        }

        $idEvent = $_GET['id_event'];

        $deleteEvent = new UpdateEventModel();

        $deleteEvent->processDeleteEvent($idEvent);

        header("Location: /admin_events");
    }
}
