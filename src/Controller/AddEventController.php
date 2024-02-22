<?php

namespace App\Controller;

use App\Models\AddEventModel;

class AddEventController
{
    public function addevent()
    {
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
        $addeventModel = new AddEventModel();

        $addeventModel->processaddevent();
    }
}
