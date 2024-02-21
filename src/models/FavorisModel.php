<?php

namespace App\Models;

class FavorisModel
{
    public function processFavoris()
    {
        global $pdo;
if(isset($_GET['id_event'])) {  
    $id_event = $_GET['id_event'];
    
    
    $id_utilisateur = 49;

    $stmt = $pdo->prepare("INSERT INTO favoris (id_utilisateur, id_event) VALUES (:id_utilisateur, :id_event)");
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    $stmt->bindParam(':id_event', $id_event);
    
    if ($stmt->execute()) {
        echo "Ajout en favori réussi!";
    } else {
        echo "Erreur lors de l'ajout en favori'.";
    }
} else {
    echo "ID de l'événement non spécifié.";
}
    }
}

?>