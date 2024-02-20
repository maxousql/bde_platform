<?php

namespace App\Controller;

class AssetController
{
    private function load($file, $type)
    {
        return __DIR__ . "/../../public/$type/$file";
    }

    //fait avec Audrey HOSSEPIAN
    public function images($file): string
    {
        ob_start();
        echo file_get_contents($this->load($file["file"], "asset/img"));
        $content = ob_get_clean();
        return $content;
    }

}
