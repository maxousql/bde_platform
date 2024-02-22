<?php

namespace App\Models;

class FavorisModel
{
    public function processFavoris()
    {
        global $pdo;
        if (isset($_GET['id_event'])) {
            $id_event = $_GET['id_event'];
            $id_utilisateur = $_SESSION['id_user'];

            // Vérifier si le billet existe déjà dans les favoris de l'utilisateur
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM favoris WHERE id_utilisateur = :id_utilisateur AND id_event = :id_event");
            $stmt->bindParam(':id_utilisateur', $id_utilisateur);
            $stmt->bindParam(':id_event', $id_event);
            $stmt->execute();
            $result = $stmt->fetchColumn();

            if ($result > 0) {
                echo "Ce billet est déjà en favori.";
            } else {
                // Ajouter le billet en favori
                $stmt = $pdo->prepare("INSERT INTO favoris (id_utilisateur, id_event) VALUES (:id_utilisateur, :id_event)");
                $stmt->bindParam(':id_utilisateur', $id_utilisateur);
                $stmt->bindParam(':id_event', $id_event);
                
                if ($stmt->execute()) {
                    header("Location: events");
                } else {
                    echo "Erreur lors de l'ajout en favori.";
                }
            }
        } else {
            echo "ID de l'événement non spécifié.";
        }
    }
}
