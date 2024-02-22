<?php

namespace App\Controller;

use App\Models\FavorisModel;

class FavorisController
{
    public function process_favoris()
    {
        if ($_SESSION['role'] === 0) {
            header("Location: /error403");
            exit;
        }
        $favorisModel = new FavorisModel();

        $favorisModel->processFavoris();
    }
}