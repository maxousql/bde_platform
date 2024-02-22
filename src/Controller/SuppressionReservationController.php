<?php

namespace App\Controller;

use App\Models\SuppressionsReservationModel;

class SuppressionReservationController
{
    public function process_suppressionreservation()
    {
        $suppressionsreservationmodel = new SuppressionsReservationModel();

        $suppressionsreservationmodel->processsuppressionreservation();
    }
}