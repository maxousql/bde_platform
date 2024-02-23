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

        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
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
        $mail->Subject = 'Validation de compte BEEDE Sciences-U';
        ob_start();
        include __DIR__ . '/../views/includes/Mailer.php';
        $mail->Body = ob_get_clean();
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    }

    public function sendemail_verify_admin($user_info)
    {
        global $pdo;

        $getAllAdmin_query = "SELECT email FROM utilisateur WHERE id_role=2";
        $getAllAdmin_query_run = $pdo->prepare($getAllAdmin_query);
        $getAllAdmin_query_run->execute();

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
        $mail->Subject = 'Nouvel utilisateur vérifié : BEEDE Sciences-U';

        //Content
        $mail->isHTML(true);

        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $admin_emails = array();

        while ($row = $getAllAdmin_query_run->fetch($pdo::FETCH_ASSOC)) {
            $admin_emails[] = $row['email'];
        }

        $message = 'Nouvel utilisateur : ID : ' . $user_info['id_utilisateur'] . ' Nom : ' . $user_info['nom'] . ' Prénom : ' . $user_info['prenom'] . ' Email : ' . $user_info['email'] . ' ID_Role : ' . $user_info['id_role'] . ' ID_Ecole : ' . $user_info['id_ecole'] . ' ID_Promotion : ' . $user_info['id_promotion'] . '';

        foreach ($admin_emails as $email) {
            $mail->addAddress($email);
            $mail->Body = $message;
            $mail->send();

        }
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
                header("Locatin: /login");
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

            $getUser_query = "SELECT * FROM utilisateur WHERE verify_token=:token LIMIT 1";
            $getUser_query_run = $pdo->prepare($getUser_query);
            $getUser_query_run->bindParam(':token', $token);
            $getUser_query_run->execute();

            $user_info = $getUser_query_run->fetch($pdo::FETCH_ASSOC);

            $this->sendemail_verify_admin($user_info);
        }
    }
}
