<?php

namespace App\Controller;

use App\Models\FavorisModel;

class FavorisController
{
    public function process_favoris()
    {
        $favorisModel = new FavorisModel();

        $favorisModel->processFavoris();
    }
}