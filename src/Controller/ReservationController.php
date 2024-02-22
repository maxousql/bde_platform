<?php

namespace App\Controller;

use App\Models\ReservationModel;

class ReservationController
{
    public function process_reservation()
    {
        if ($_SESSION['role'] === 0) {
            header("Location: /error403");
            exit;
        }
        $reservationModel = new ReservationModel();

        $reservationModel->processReservation();
    }
}
