<?php

namespace App\Models;

class SuppressionsReservationModel
{
    public function processsuppressionreservation()
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
}

?>
