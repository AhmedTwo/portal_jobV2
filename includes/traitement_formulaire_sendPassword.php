<?php

// Vérifie si une session PHP n'a pas encore été démarrée
if (session_status() === PHP_SESSION_NONE) {

    // Si aucune session active, démarre une nouvelle session
    session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Chemins corrects avec __DIR__ pour éviter les problèmes de chemins relatifs
require_once dirname(__DIR__) . '/vendor/autoload.php';

function sendPassword(string $email, string $password): void
{

    $message = "
        Bonjour,<br><br>
        Nous avons bien reçu votre demande de mot de passe oublié<br>
        Voici désormais vos identifiants pour Portal_Job :<br>
        Je vous invite à les garder précieusement !<br><br>
        <strong>EMAIL :</strong> {$email}<br>
        <strong>MOT DE PASSE :</strong> {$password}<br><br>
        Cordialement,<br>
        L'équipe Portal_Job.
        ";


    $mail = new PHPMailer(true);

    // Mode debug (à retirer en production)
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'seghiriahmed9@gmail.com';
        $mail->Password = 'nbjplfluxfyrjken';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Options SSL pour contourner les problèmes de certificat
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('seghiriahmed9@gmail.com', 'Portal_Job');
        $mail->addAddress($email); // mail du formulaire
        // $mail->addAddress('seghiriahmed9@gmail.com'); // mail brut
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "Vos identifiants de connexion";
        $mail->Body = $message;

        $mail->send();
        echo "<div class='alert alert-success text-center'>Votre demande a été envoyée avec succès!</div>";
        header("Location: /connexion");
        exit;
    } catch (Exception $e) {
        echo "<div class='alert alert-danger text-center'>Erreur lors de l'envoi du mail : {$mail->ErrorInfo}</div>";
    }
}
