<?php

namespace App\Models;

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
            $photo_Event = $_POST['photo_Event'];
            $id_categorie = $_POST['id_categorie'];
            $date_evenement = $_POST['date_evenement'];
            $heure_evenement = $_POST['heure_evenement'];
            $prix = $_POST['prix'];

            // Combinez la date et l'heure dans un format de date MySQL
            $date_event = $date_evenement . ' ' . $heure_evenement;


            $stmt = $pdo->prepare("INSERT INTO event (nom_event, description_event, adresse, photo_Event, prix, date_event, id_categorie) VALUES (:nom_event, :description_event, :adresse, :photo_Event, :prix, :date_event, :id_categorie)");

            $stmt->bindParam(':nom_event', $nom_event);
            $stmt->bindParam(':description_event', $description_event);
            $stmt->bindParam(':adresse', $adresse);
            $stmt->bindParam(':photo_Event', $photo_Event);
            $stmt->bindParam(':id_categorie', $id_categorie);
            $stmt->bindParam(':date_event', $date_event);
            $stmt->bindParam(':prix', $prix);

            // Exécuter la requête
            $stmt->execute();
        }
    }
}
