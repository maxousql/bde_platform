<?php

namespace App\Controller;

class MesReservationController
{
    public function mesreservation()
    {
        if ($_SESSION['role'] === 0) {
            header("Location: /error403");
            exit;
        }
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
