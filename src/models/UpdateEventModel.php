<?php

namespace App\Models;

class UpdateEventModel
{
    public function processEditEvent()
    {
        global $pdo;

        if (isset($_GET['id_event'])) {
            $id_event = $_GET['id_event'];
            $getEventQuery = $pdo->prepare("SELECT * FROM event 
            INNER JOIN categorie_event ON event.id_categorie = categorie_event.id_categorie
            WHERE id_event=:id_event ");
            $getEventQuery->bindParam(':id_event', $id_event);
            $getEventQuery->execute();
            $eventData = $getEventQuery->fetch();
            $imageData = base64_encode($eventData['photo_Event']);
            $src = 'data:image/jpeg;base64,' . $imageData;
            $eventData['photo_Event'] = $src;
        } else {
            echo "ID de l'événement non spécifié.";
        }

        return $eventData;
    }
    public function processUpdateEvent($eventData)
    {
        global $pdo;

        $updateEvent_query = "UPDATE event SET nom_event = :nom_event, description_event = :description_event, adresse = :adresse, id_categorie = :id_categorie, prix = :prix, date_event = :date_event WHERE id_event = :id_event";
        $updateEvent_query_run = $pdo->prepare($updateEvent_query);
        $updateEvent_query_run->execute([
            ":nom_event" => $eventData['nom'],
            ":description_event" => $eventData['description'],
            ":adresse" => $eventData['adresse'],
            ":id_categorie" => $eventData['id_categorie'],
            ":prix" => $eventData['prix'],
            ":date_event" => $eventData['date'],
            ":id_event" => $eventData['id_event']
        ]);
    }

    public function processDeleteEvent($idEvent)
    {
        global $pdo;

        $deleteFavoris_query = "DELETE FROM favoris WHERE id_event = $idEvent";
        $deleteFavoris_query_run = $pdo->prepare($deleteFavoris_query);
        $deleteFavoris_query_run->execute();

        $deleteBillet_query = "DELETE FROM billet WHERE id_event = $idEvent";
        $deleteBillet_query_run = $pdo->prepare($deleteBillet_query);
        $deleteBillet_query_run->execute();

        $deleteEvent_query = "DELETE FROM event WHERE id_event = $idEvent";
        $deleteEvent_query_run = $pdo->prepare($deleteEvent_query);
        $deleteEvent_query_run->execute();

        header("Location: /admin_events");
        exit();
    }
}
