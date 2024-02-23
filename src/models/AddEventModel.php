<?php

namespace App\Models;

use PDO;

class AddEventModel
{
    public function processaddevent()
    {
        global $pdo;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $nom_event = $_POST['nom_event'];
            $description_event = $_POST["description_event"];
            $adresse = $_POST['adresse'];
            $id_categorie = $_POST['id_categorie'];
            $date_evenement = $_POST['date_evenement'];
            $heure_evenement = $_POST['heure_evenement'];
            $prix = $_POST['prix'];

            // Combinez la date et l'heure dans un format de date MySQL
            $date_event = $date_evenement . ' ' . $heure_evenement;

            // Vérifier si un fichier a été téléchargé
            if (isset($_FILES['photo_Event']) && $_FILES['photo_Event']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['photo_Event']['tmp_name'];

                // Lire le contenu du fichier
                $photo_Event = file_get_contents($fileTmpPath);

                // Préparer la requête SQL pour insérer l'événement avec l'image en tant que LONGBLOB dans la base de données
                $stmt = $pdo->prepare("INSERT INTO event (nom_event, description_event, adresse, photo_Event, prix, date_event, id_categorie) VALUES (:nom_event, :description_event, :adresse, :photo_Event, :prix, :date_event, :id_categorie)");

                // Liaison des valeurs aux paramètres de la requête
                $stmt->bindParam(':nom_event', $nom_event);
                $stmt->bindParam(':description_event', $description_event);
                $stmt->bindParam(':adresse', $adresse);
                $stmt->bindParam(':photo_Event', $photo_Event, PDO::PARAM_LOB);
                $stmt->bindParam(':id_categorie', $id_categorie);
                $stmt->bindParam(':date_event', $date_event);
                $stmt->bindParam(':prix', $prix);

                // Exécuter la requête
                $stmt->execute();

                // Redirection vers une page de confirmation ou une autre action après l'insertion réussie
                // header("Location: chemin/vers/page-de-confirmation.php");
                // exit();
            } else {
                // Gérer le cas où aucun fichier n'est téléchargé
                echo "Veuillez sélectionner une image.";
            }
        }
    }
}
    