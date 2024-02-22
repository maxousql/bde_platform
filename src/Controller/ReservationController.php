<?php

namespace App\Controller;

use App\Models\ReservationModel;

class ReservationController
{
    public function process_reservation()
    {
        $reservationModel = new ReservationModel();

        $reservationModel->processReservation();
    }
}
