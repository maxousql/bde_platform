<?php

namespace App\Controller;

class AssetController
{
    private function load($file, $type)
    {
        return __DIR__ . "../../public/$type/$file";
    }

    public function images($file): string
    {
        ob_start();
        include $this->load($file["file"], "img");
        $content = ob_get_clean();
        return $content;
    }

}
