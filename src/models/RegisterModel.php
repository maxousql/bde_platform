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
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    }
    public function processRegister($userData)
    {
        global $pdo;
        var_dump($_POST);
        session_start();
        if (isset($_POST['valid_register'])) {
            extract($_POST);

            $verify_token = md5(rand());

            $check_email_query = "SELECT email FROM utilisateur WHERE email=? LIMIT 1";
            $check_email_query_run = $pdo->prepare($check_email_query);
            $check_email_query_run->execute([$email]);

            if ($check_email_query_run->rowCount() > 0) {
                $_SESSION['status'] = "Email Id already Exists";
                header("Location: login");
            } else {
                $query = "INSERT INTO utilisateur(nom, prenom, email, verify_token, id_role, id_ecole, id_promotion, mdp) VALUES (:name, :firstname, :email, :verify_token, :id_role, :id_ecole, :id_promotion, :password)";
                $query_run = $pdo->prepare($query);
                $query_run->execute([":name" => $name, ":firstname" => $firstname, ":email" => $email, ":verify_token" => $verify_token, ":id_role" => 1, ":id_ecole" => 1, ":id_promotion" => 1, ":password" => $password]);
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

    public function verify_email()
    {
        if (isset($_GET['token'])) {

        } else {

        }
    }
}