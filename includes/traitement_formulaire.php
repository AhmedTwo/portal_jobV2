<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Chemins corrects avec __DIR__ pour éviter les problèmes de chemins relatifs
require_once dirname(__DIR__) . '/config/database.php';
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/models/Companys.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $message = "
    Bonjour,

    Votre demande d'ajout de compagnie,
    Venant de l'entreprise suivante : {$_POST['inputNom']}

    A bien été reçue. Voici un récapitulatif des informations que vous avez transmises :

        NOM : {$_POST['inputNom']}\n
        NOMBRE EMPLOYES : {$_POST['inputNbEmploye']}\n
        DOMAINE : {$_POST['inputDomaine']}\n
        ADRESSE : {$_POST['inputAdresse']}\n
        LATITUDE : {$_POST['inputLatitutde']}\n
        LONGITUDE : {$_POST['inputLongitude']}\n
        DESCRIPTION : {$_POST['inputDescription']}\n
        EMAIL : {$_POST['inputEmail']}\n
        N_SIRET : {$_POST['inputSiret']}\n
        LOGO : {$_POST['inputLogo']}

    Notre équipe étudiera attentivement votre dossier et vous contactera si votre compagnie correspond aux critères.
    
    Cordialement,
    L'équipe Recrutement
    ";

    $mail = new PHPMailer(true);

    try {
        // Configuration SMTP Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ajc95ajc@gmail.com'; // Ton adresse Gmail
        $mail->Password = 'csyc eevh mqki ozbw'; // Ton mot de passe d'application Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;


        // Infos mail
        $mail->setFrom('ajc95ajc@gmail.com', 'Form New Company'); // Authentifié avec Gmail
        $mail->addReplyTo($_POST['inputEmail'], 'Utilisateur');   // le addReplyTo permet de répondre à l'utilisateur de l'envoi qui est le mail mis dans le form
        $mail->addAddress('ajc95ajc@gmail.com');
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->Subject = 'Nouveau formulaire soumis';
        $mail->Body = $message;

        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ];

        $mail->send();

        echo "<div class='alert alert-success text-center'>Email envoyé avec succès avec PHPMailer.</div>";
        echo '<meta http-equiv="refresh" content="1;url=/index.php">';
    } catch (Exception $e) {
        echo "<div class='alert alert-danger text-center'>Erreur : {$mail->ErrorInfo}</div>";
    }
}
