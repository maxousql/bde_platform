<?php

namespace App\Controller;

use App\Models\UpdateEventModel;

class AdminEventController
{
    public function process_deleteEvent()
    {
        if ($_SESSION['role'] === 1) {
            header("Location: /error403");
            exit;
        }

        $idEvent = $_GET['id_event'];

        $deleteEvent = new UpdateEventModel();

        $deleteEvent->processDeleteEvent($idEvent);

        header("Location: /admin_events");
    }

    public function processUpdateEvent($eventData)
    {
        if ($_SESSION['role'] != 2) {
            header("Location: /error403");
            exit;
        }
        if ($_SESSION['role'] != 2) {
            header("Location: /error403");
            exit;
        }
        $eventData = $_POST;
        $updateEventModel = new UpdateEventModel();

        try {
            $updateEventModel->processUpdateEvent($eventData);
            $idEvent = $eventData['id_event'];
            $_SESSION['status_update_event'] = 1;
            header("Location: /process_editEvent?id_event=$idEvent");
        } catch (\Throwable $th) {
            $_SESSION['status_update_user'] = 0;
        }
    }

    public function edit_event($eventData)
    {
        if ($_SESSION['role'] != 2) {
            header("Location: /error403");
            exit;
        }
        if (isset($_SESSION['status_update_event']) || $_SESSION['status_update_event'] === 1) {
            unset($_SESSION['status_update_event']);
            $validUpdate = 1;
        } elseif (isset($_SESSION['status_update_event']) || $_SESSION['status_update_event'] === 0) {
            unset($_SESSION['status_update_event']);
            $validUpdate = 2;
        }
        $viewPath = __DIR__ . '/../views/includes/EditEvents.php';
        $title = "Modification événements";
        $style = "editUser.css";
        $currentPage = "admin_events";

        if (file_exists($viewPath)) {
            ob_start();
            include $viewPath;
            $content = ob_get_clean();
            include __DIR__ . '/../views/layout.php';
        } else {
            return "Erreur: Vue introuvable";
        }
    }

    public function process_editEvent()
    {
        if ($_SESSION['role'] != 2) {
            header("Location: /error403");
            exit;
        }
        if ($_SESSION['role'] != 2) {
            header("Location: /error403");
        }
        $editUserModel = new UpdateEventModel();

        $eventData = $editUserModel->processEditEvent();
        $this->edit_event($eventData);
    }
}
