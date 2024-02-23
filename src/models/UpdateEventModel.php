<?php

namespace App\Models;

class UpdateEventModel
{
    public function processUpdateEvent()
    {
        global $pdo;

        $id_billet = $_GET['id_billet'];


        $stmt = $pdo->prepare("SELECT id_event FROM billet WHERE id_billet = ?");
        $stmt->execute([$id_billet]);
        $event_id = $stmt->fetchColumn();

        $pdo->query("DELETE FROM billet WHERE id_billet = $id_billet");

        $pdo->query("UPDATE event SET nombre_de_participants = nombre_de_participants - 1 WHERE id_event = $event_id");

        header("Location: mesreservation");
        exit();
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
