<?php

namespace App\Models;

class ReservationModel
{
    public function processReservation()
    {
        global $pdo;
if(isset($_GET['id_event'])) {  
    $id_event = $_GET['id_event'];
    
    
    $id_utilisateur = 22;

    $stmt = $pdo->prepare("INSERT INTO billet (id_utilisateur, id_event) VALUES (:id_utilisateur, :id_event)");
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    $stmt->bindParam(':id_event', $id_event);
    
    if ($stmt->execute()) {
        echo "Billet créé avec succès!";
    } else {
        echo "Erreur lors de la création du billet.";
    }
} else {
    echo "ID de l'événement non spécifié.";
}
    }
}

?>
