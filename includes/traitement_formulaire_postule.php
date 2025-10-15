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
require_once dirname(__DIR__) . '/models/Offer.php';
require_once dirname(__DIR__) . '/models/User.php';

function sendEmail(int $id): void
{
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        return; // sécurité : on ne traite que du POST
    }

    if (!$id || $id <= 0) {
        die("ID de l'offre invalide !");
    }

    // Vérifier que l'utilisateur est connecté
    if (!isset($_SESSION['new_id'])) {
        die('Vous devez être connecté pour postuler.');
    }

    $user_id = (int) $_SESSION['new_id'];

    // Récupérer l'offre
    $offerModel = new Offer();
    $offerApply = $offerModel->offerApply($id);

    // Récupérer les infos utilisateur
    $userModel = new User();
    $userApply = $userModel->readProfil($user_id);

    if (!$offerApply || !$userApply) {
        die("Erreur lors de la récupération des données !");
    }

    // Gestion du fichier uploadé
    $lettre_file = $_FILES['inputLettre']['name'] ?? 'Non fourni';

    // Construire le message
    $message = "
            Bonjour {$userApply['nom']} {$userApply['prenom']},

            Votre candidature à l'offre suivante : {$offerApply['title']}
            Entreprise : {$offerApply['company_name']}

            Informations transmises :
            NOM : {$userApply['nom']}
            PRÉNOM : {$userApply['prenom']}
            VILLE : {$userApply['ville']}
            CODE POSTAL : {$userApply['code_postal']}
            TÉLÉPHONE : {$userApply['telephone']}
            EMAIL : {$userApply['email']}

            MOTIVATION :
            {$_POST['inputMotivation']}

            LETTRE DE MOTIVATION : {$lettre_file}
            CV : {$userApply['cv_pdf']}

            Notre équipe étudiera attentivement votre dossier et vous contactera si votre profil correspond à nos attentes.

            Cordialement,
            L'équipe Recrutement
            ";

    $mail = new PHPMailer(true);

    try {
        // Configuration SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ajc95ajc@gmail.com';
        $mail->Password = 'csyc eevh mqki ozbw'; // ⚠️ mettre en variable d'environnement !
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Infos expéditeur/destinataire
        $mail->setFrom($userApply['email'], $userApply['nom'] . ' ' . $userApply['prenom']);
        $mail->addAddress('ajc95ajc@gmail.com');
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->Subject = "Candidature pour l'offre: {$offerApply['title']}";
        $mail->Body = $message;

        // Pièce jointe : lettre de motivation
        if (!empty($_FILES['inputLettre']['tmp_name']) && $_FILES['inputLettre']['error'] === 0) {
            $mail->addAttachment($_FILES['inputLettre']['tmp_name'], $_FILES['inputLettre']['name']);
        }

        // Options SSL
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ];

        // Envoi
        $mail->send();

        echo "<div class='alert alert-success text-center'>Votre candidature a été envoyée avec succès!</div>";
        echo '<meta http-equiv="refresh" content="1;url=/accueil">';
    } catch (Exception $e) {
        echo "<div class='alert alert-danger text-center'>Erreur lors de l'envoi du mail : {$mail->ErrorInfo}</div>";
    }
}
