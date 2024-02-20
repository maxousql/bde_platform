<?php

namespace App\Controller;

class EventsController
{
    public function events(): string
    {

        $viewPath = __DIR__ . '/../views/includes/Events.php';
        $title = "Events";
        $style = "events.css";
        $currentPage = "events";

        if (file_exists($viewPath)) {
            ob_start();
            $content = file_get_contents($viewPath);
            include __DIR__ . '/../views/layout.php';
            return ob_get_clean();
        } else {
            return "Erreur: Vue introuvable";
        }
    }
}
