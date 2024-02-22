<?php

namespace App\Models;

class EditUserModel
{
    public function processEditUser()
    {
        global $pdo;

        if (isset($_GET['id_user'])) {
            $id_user = $_GET['id_user'];

            $getUserQuery = $pdo->prepare("SELECT * FROM utilisateur WHERE id_utilisateur=:id_user");
            $getUserQuery->bindParam(':id_user', $id_user);
            $getUserQuery->execute();
            $userData = $getUserQuery->fetch();
        } else {
            echo "ID de l'événement non spécifié.";
        }

        return $userData;
    }

    public function processUpdateUser()
    {
        global $pdo;

        if (isset($_GET['id_user'])) {
            $id_user = $_GET['id_user'];

            $getUserQuery = $pdo->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, id_role = :id_role, id_ecole = :id_ecole, id_promotion = :id_promotion, mdp = :mdp WHERE id_utilisateur=:id_user");
            $getUserQuery->bindParam(':id_user', $id_user);
            $getUserQuery->execute();
            $userData = $getUserQuery->fetch();
        } else {
            echo "ID de l'événement non spécifié.";
        }
    }
}
