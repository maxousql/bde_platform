<?php

namespace App\Models;

class LoginModel
{
    public function processLogin($userData)
    {
        global $pdo;

        if (isset($_POST['valid_login'])) {
            extract($_POST);

            $check_user = "SELECT * FROM utilisateur WHERE email=:email LIMIT 1";
            $check_user_query_run = $pdo->prepare($check_user);
            $check_user_query_run->execute(["email" => $email]);

            $row = $check_user_query_run->fetch($pdo::FETCH_ASSOC);

            if ($row) {
                if (password_verify($password, $row['mdp'])) {
                    $_SESSION['id_user'] = $row['id_utilisateur'];
                    $_SESSION['role'] = $row['id_role'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['nom'];
                    $_SESSION['firstname'] = $row['prenom'];
                    header("Location: /home");
                    exit;
                } else {
                    // MDP INCORRECT
                    header("Location: /login?error=password");
                    exit;
                }
            } else {
                // EMAIL INCORERECT -> UTILISATEUR INTROUVABLE
                header("Location: /login?error=user_not_found");
                exit;
            }
        }
    }
}