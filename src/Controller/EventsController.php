<?php

namespace App\Controller;

class EventsController
{
    public function events()
    {
        $viewPath = __DIR__ . '/../views/includes/Events.php';
        $title = "Events";
        $style = "events.css";
        $currentPage = "events";

        if (file_exists($viewPath)) {
            ob_start();
            include $viewPath;
            $content = ob_get_clean();
            include __DIR__ . '/../views/layout.php';
        } else {
            return "Erreur: Vue introuvable";
        }
    }
}
