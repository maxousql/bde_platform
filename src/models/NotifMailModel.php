<?php

namespace App\Models;

class NotifMailModel
{
    public function sendemail_j1()
    {
        global $pdo;

        try {
            // Requête SQL pour récupérer les événements
            $getEvents_query = "SELECT DISTINCT id_event FROM billet";

            // Préparation et exécution de la requête SQL
            $getEvents_query_run = $pdo->prepare($getEvents_query);
            $getEvents_query_run->execute();

            // Boucle à travers chaque événement
            while ($row = $getEvents_query_run->fetch($pdo::FETCH_ASSOC)) {
                $eventId = $row['id_event'];

                // Requête SQL pour récupérer les e-mails des participants pour cet événement
                $getEmails_query = "SELECT DISTINCT utilisateur.email 
                            FROM billet 
                            INNER JOIN utilisateur ON billet.id_utilisateur = utilisateur.id_utilisateur 
                            WHERE billet.id_event = :eventId";

                // Préparation et exécution de la requête SQL
                $getEmails_query_run = $pdo->prepare($getEmails_query);
                $getEmails_query_run->bindParam(':eventId', $eventId, $pdo::PARAM_INT);
                $getEmails_query_run->execute();

                // Traitement des e-mails récupérés pour cet événement
                $emails = array();
                while ($emailRow = $getEmails_query_run->fetch($pdo::FETCH_ASSOC)) {
                    $emails[] = $emailRow['email'];

                    // Récupérer la date de l'événement correspondant à l'ID de l'événement
                    $getEventDate_query = "SELECT date_event FROM event WHERE id_event = :eventId";
                    $getEventDate_query_run = $pdo->prepare($getEventDate_query);
                    $getEventDate_query_run->bindParam(':eventId', $eventId, $pdo::PARAM_INT);
                    $getEventDate_query_run->execute();
                    $eventDateRow = $getEventDate_query_run->fetch($pdo::FETCH_ASSOC);
                    $eventDate = $eventDateRow['date_event'];

                    $eventDateTime = new \DateTime($eventDate);

                    $eventDateTime->modify('-1 day');

                    $eventDateMinusOneDay = $eventDateTime->format('Y-m-d');

                    $currentDateMinusOneDay = date('Y-m-d');
                    if ($eventDateMinusOneDay == $currentDateMinusOneDay) {
                        var_dump('rappel J-1 avant event after', $emailRow['email']);
                    }
                }
            }
        } catch (\PDOException $e) {
            // Gestion des erreurs de connexion ou d'exécution de la requête
            echo "Erreur: " . $e->getMessage();
        }

    }
}


