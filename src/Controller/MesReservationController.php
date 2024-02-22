<?php

namespace App\Controller;

class MesReservationController
{
    public function mesreservation()
    {
        $viewPath = __DIR__ . '/../views/includes/MesReservation.php';
        $title = "MesReservation";
        $style = "mesreservation.css";
        $currentPage = "mesreservation";

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
