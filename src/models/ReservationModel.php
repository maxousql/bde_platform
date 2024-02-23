<?php

namespace App\Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class ReservationModel
{
    public function sendemail_confirm_event($id_event, $email, $firstname)
    {
        global $pdo;

        $getNameEvent_query = "SELECT nom_event FROM event WHERE id_event=? LIMIT 1";
        $getNameEvent_query_run = $pdo->prepare($getNameEvent_query);
        $getNameEvent_query_run->execute([$id_event]);

        $event_name = $getNameEvent_query_run->fetchColumn();

        $mail = new PHPMailer(true);

        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->SMTPAuth = true;

        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'mlaiyiolaitong@gmail.com';
        $mail->Password = 'pigv gjfs cecj zlfw';

        $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('mlaiyiolaitong@gmail.com', 'BEEDE Sciences-U');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Confirmation ' . $event_name;
        $mail->Body = 'Bonjour ' . $firstname . ', voici votre billet !';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    }
    public function processReservation()
    {
        global $pdo;
        if (isset($_GET['id_event'])) {
            $id_event = $_GET['id_event'];
            $id_utilisateur = $_SESSION['id_user'];
            $firstname = $_SESSION['fistname'];
            $email = $_SESSION['email'];

            // D'abord, insérez le billet
            $stmt = $pdo->prepare("INSERT INTO billet (id_utilisateur, id_event) VALUES (:id_utilisateur, :id_event)");
            $stmt->bindParam(':id_utilisateur', $id_utilisateur);
            $stmt->bindParam(':id_event', $id_event);

            if ($stmt->execute()) {
                header("Location: events");

                // Ensuite, mettez à jour le nombre de participants pour cet événement
                $updateStmt = $pdo->prepare("UPDATE event SET nombre_de_participants = nombre_de_participants + 1 WHERE id_event = :id_event");
                $updateStmt->bindParam(':id_event', $id_event);

                if ($updateStmt->execute()) {
                    $this->sendemail_confirm_event($id_event, $email, $firstname);
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