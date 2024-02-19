<?php

namespace App\Controller;

class IndexController
{
    public function home(): string
    {
        // Chemin vers le fichier HTML de la vue
        $viewPath = __DIR__ . '/../views/Home.php';

        // Vérification de l'existence du fichier
        if (file_exists($viewPath)) {
            // Lecture du contenu du fichier
            $content = file_get_contents($viewPath);

            // Retourne le contenu du fichier HTML
            return $content;
        } else {
            // Si le fichier n'existe pas, retourne un message d'erreur
            return "Erreur: Vue introuvable";
        }
    }

    public function contact(): string
    {
        return "Contact";
    }
}
