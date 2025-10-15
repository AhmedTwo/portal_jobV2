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
require_once dirname(__DIR__) . '/models/Company.php';

function sendMail(string $destinataire, string $login, string $password): bool
{
    $message = "
    Bonjour,<br><br>
    Nous avons le plaisir de vous compter parmis nous chez Portal_Job,<br>
    Vous retrouvez ci-joint vos identifiants de connexion à notre plateforme :<br><br>
    <strong>Email :</strong> {$login}<br>
    <strong>Mot de passe :</strong> {$password}<br><br>
    Je vous invite à modifier votre mot de passe sur votre page Profil une fois connecté si vous le souhaitez <br><br>
    Cordialement,<br>L'équipe Portal_Job.
    ";

    $mail = new PHPMailer(true);

    try {
        // Mode debug (à retirer en production)
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';

        // Configuration SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ajc95ajc@gmail.com';
        $mail->Password = 'csyc eevh mqki ozbw'; // ⚠️ A mettre en variable d'environnement
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

        // Infos expéditeur/destinataire
        $mail->setFrom('ajc95ajc@gmail.com', 'Portal_Job');
        $mail->addAddress($destinataire); // Utiliser le vrai destinataire
        // $mail->addAddress('seghiriahmed9@gmail.com'); // Pour test

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->Subject = "Vos identifiants de connexion - Portal_Job";
        $mail->Body = $message;

        $mail->send();
        echo "<div class='alert alert-success'>✅ Mail envoyé avec succès à {$destinataire}</div>";
        echo '<meta http-equiv="refresh" content="1;url=/connexion">';

        return true;
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>❌ Erreur lors de l'envoi du mail : {$mail->ErrorInfo}</div>";
        error_log("Erreur PHPMailer: " . $mail->ErrorInfo);
        return false;
    }
}
