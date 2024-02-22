<?php

namespace App\Models;

class ReservationModel
{
    public function processReservation()
    {
        global $pdo;
        if(isset($_GET['id_event'])) {  
            $id_event = $_GET['id_event'];
            $id_utilisateur = $_SESSION['id_user'];

            // D'abord, insérez le billet
            $stmt = $pdo->prepare("INSERT INTO billet (id_utilisateur, id_event) VALUES (:id_utilisateur, :id_event)");
            $stmt->bindParam(':id_utilisateur', $id_utilisateur);
            $stmt->bindParam(':id_event', $id_event);

            if ($stmt->execute()) {
                echo "Billet créé avec succès!";

                // Ensuite, mettez à jour le nombre de participants pour cet événement
                $updateStmt = $pdo->prepare("UPDATE event SET nombre_de_participants = nombre_de_participants + 1 WHERE id_event = :id_event");
                $updateStmt->bindParam(':id_event', $id_event);

                if ($updateStmt->execute()) {
                    echo " Nombre de participants mis à jour avec succès.";
                } else {
                    echo " Erreur lors de la mise à jour du nombre de participants.";
                }

            } else {
                echo "Erreur lors de la création du billet.";
            }
        } else {
            echo "ID de l'événement non spécifié.";
        }
    }
}

?>
