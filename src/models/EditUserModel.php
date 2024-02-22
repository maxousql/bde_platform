<?php

namespace App\Models;

class EditUserModel
{
    public function processEditUser()
    {
        global $pdo;

        if (isset($_GET['id_user'])) {
            $id_user = $_GET['id_user'];

            $getUserQuery = $pdo->prepare("SELECT * FROM utilisateur 
            INNER JOIN ecole ON utilisateur.id_ecole = ecole.id_ecole
            INNER JOIN promotion ON utilisateur.id_promotion = promotion.id_promotion 
            INNER JOIN role ON utilisateur.id_role = role.id_role
            WHERE id_utilisateur=:id_user ");
            $getUserQuery->bindParam(':id_user', $id_user);
            $getUserQuery->execute();
            $userData = $getUserQuery->fetch();
        } else {
            echo "ID de l'événement non spécifié.";
        }

        return $userData;
    }

    public function processUpdateUser($userData)
    {
        global $pdo;

        $passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);

        $updateUser_query = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, id_role = :id_role, id_ecole = :id_ecole, id_promotion = :id_promotion, mdp = :password WHERE id_utilisateur = :id_user";
        $updateUser_query_run = $pdo->prepare($updateUser_query);
        $updateUser_query_run->execute([
            ":nom" => $userData['name'],
            ":prenom" => $userData['firstname'],
            ":email" => $userData['email'],
            ":id_role" => $userData['role'],
            ":id_ecole" => $userData['school'],
            ":id_promotion" => $userData['promotion'],
            ":password" => $passwordHash,
            ":id_user" => $userData['id_user']
        ]);
    }

    public function processAddUser()
    {
        extract($_POST);

        global $pdo;

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $verify_token = md5(rand());

        $addUser_query = "INSERT INTO utilisateur (nom, prenom, email, verify_token, verify_email, id_role, id_ecole, id_promotion, mdp) VALUE (:nom, :prenom, :email, :verify_token, :verify_email, :id_role, :id_ecole, :id_promotion, :mdp)";
        $addUser_query_run = $pdo->prepare($addUser_query);
        $addUser_query_run->execute([
            ":nom" => $name,
            ":prenom" => $firstname,
            ":email" => $email,
            ":verify_token" => $verify_token,
            ":verify_email" => 1,
            ":id_role" => $role,
            ":id_ecole" => $school,
            ":id_promotion" => $promotion,
            ":mdp" => $passwordHash
        ]);
    }

    public function processDeleteUser($idUser)
    {
        global $pdo;

        $deleteUser_query = "DELETE FROM utilisateur WHERE id_utilisateur = $idUser";
        $deleteUser_query_run = $pdo->prepare($deleteUser_query);
        $deleteUser_query_run->execute();
    }
}
