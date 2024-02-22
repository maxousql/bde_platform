<?php

namespace App\Controller;

use App\Models\SuppressionFavorisModel;

class SuppressionFavorisController
{
    public function process_suppressionfavoris()
    {
        $suppressionfavorisModel = new SuppressionFavorisModel();

        $suppressionfavorisModel->processsuppressionFavoris();
    }
}