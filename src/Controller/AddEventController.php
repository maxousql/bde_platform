<?php

namespace App\Controller;

use App\Models\AddEventModel;

class AddEventController
{
    public function addevent()
    {
        if ($_SESSION['role'] === 0) {
            header("Location: /error403");
            exit;
        }
        if ($_SESSION['role'] === 1) {
            header("Location: /error403");
            exit;
        }
        $viewPath = __DIR__ . '/../views/includes/add_events.php';
        $title = "AddEvent";
        $style = "addevent.css";
        $currentPage = "addevent";

        if (file_exists($viewPath)) {
            ob_start();
            include $viewPath;
            $content = ob_get_clean();
            include __DIR__ . '/../views/layout.php';
        } else {
            return "Erreur: Vue introuvable";
        }
    }
    public function process_addevent()
    {
        if ($_SESSION['role'] === 0) {
            header("Location: /error403");
            exit;
        }
        if ($_SESSION['role'] === 1) {
            header("Location: /error403");
            exit;
        }
        $addeventModel = new AddEventModel();

        $addeventModel->processaddevent();

        header("Location: /admin_events");
    }
}
