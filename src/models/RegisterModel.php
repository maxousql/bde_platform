<?php

namespace App\Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class RegisterModel
{
    public function sendemail_verify($name, $email, $verify_token)
    {
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
        $mail->setFrom('mlaiyiolaitong@gmail.com', 'Maxime');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Validation de compte BEEDE Sciences-U';
        ob_start();
        include __DIR__ . '/../views/includes/Mailer.php';
        $mail->Body = ob_get_clean();
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    }
    public function processRegister($userData)
    {
        global $pdo;
        session_start();
        if (isset($_POST['valid_register'])) {
            extract($_POST);
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $verify_token = md5(rand());

            $check_email_query = "SELECT email FROM utilisateur WHERE email=? LIMIT 1";
            $check_email_query_run = $pdo->prepare($check_email_query);
            $check_email_query_run->execute([$email]);

            if ($check_email_query_run->rowCount() > 0) {
                $_SESSION['status'] = "Email Id already Exists";
                header("Location: login");
            } else {
                $query = "INSERT INTO utilisateur(nom, prenom, email, verify_email, verify_token, id_role, id_ecole, id_promotion, mdp) VALUES (:name, :firstname, :email, :verify_email, :verify_token, :id_role, :id_ecole, :id_promotion, :password)";
                $query_run = $pdo->prepare($query);
                $query_run->execute([":name" => $name, ":firstname" => $firstname, ":email" => $email, ":verify_email" => 0, ":verify_token" => $verify_token, ":id_role" => 1, ":id_ecole" => $ecole, ":id_promotion" => $promotion, ":password" => $passwordHash]);
            }

            if ($query_run) {
                $this->sendemail_verify($name, $email, $verify_token);
                $_SESSION['status'] = "Registration Successfull! Please verify your Email Address";
                header("Locatin: register");
                var_dump($_SESSION['status']);
            } else {
                $_SESSION['status'] = "Registration Failed";
                echo "Registration Failed!";
                header("Location: /register");
            }
        }
    }

    public function process_verify_email($token)
    {
        global $pdo;

        $verify_email = "SELECT verify_email FROM utilisateur WHERE verify_token=:token LIMIT 1";
        $verify_email_query_run = $pdo->prepare($verify_email);
        $verify_email_query_run->bindParam(':token', $token);
        $verify_email_query_run->execute();

        $row = $verify_email_query_run->fetch($pdo::FETCH_ASSOC);
        if ($row['verify_email']) {
            header("Location: /");
        } elseif ($row['verify_email'] === null) {
            header("Location: /register");
        } else {
            $valid_token = "UPDATE utilisateur SET verify_email = 1 WHERE verify_token=:token LIMIT 1";
            $valid_token_run = $pdo->prepare($valid_token);
            $valid_token_run->bindParam(':token', $token);
            $valid_token_run->execute();
        }
    }
}
