<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Chemins corrects avec __DIR__ pour éviter les problèmes de chemins relatifs
require_once dirname(__DIR__) . '/config/database.php';
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/models/Offer.php';
require dirname(__DIR__) . '/models/Users.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // definir sa variable avant de l'utiliser
    // on converti sa valeur en entier et on l'assigne à l'id sinon mettre null
    // sa evite une erreur du type : Undefined array key 'id'.
    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

    // on verifie sa validité
    if (!$id) {
        die("ID de l'offre manquant !");
    }

    if (!isset($_SESSION['new_id'])) {
        die('Vous devez être connecté pour postuler.');
    }

    // on récupère l’id utilisateur
    $user_id = $_SESSION['new_id'];

    $apply = new Offer();
    $offerApply = $apply->offerApply($pdo, $id);

    $user = new Users();
    $userApply = $user->readProfil($pdo, $user_id);

    // Si $offerApply est faux OU $userApply est faux alors le die se met en action
    if (!$offerApply || !$userApply) {
        die("Erreur lors de la récupération des données !");
    }

    // Gestion des fichiers uploadés
    $lettre_file = $_FILES['inputLettre']['name'] ?? 'Non fourni';

    $message = "
    Bonjour {$userApply['nom']} {$userApply['prenom']},

    Votre candidature à l'offre suivante : {$offerApply['title']}
    Venant de l'entreprise suivante : {$offerApply['company_name']}

    A bien été reçue. Voici un récapitulatif des informations que vous avez transmises :

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
        // Configuration SMTP Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ajc95ajc@gmail.com'; // Ton adresse Gmail
        $mail->Password = 'csyc eevh mqki ozbw'; // Ton mot de passe d'application Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Infos mail
        $mail->setFrom($userApply['email'], $userApply['nom'] . ' ' . $userApply['prenom']);
        $mail->addAddress('ajc95ajc@gmail.com'); // adresse destinataire
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->Subject = "Candidature pour l'offre: {$offerApply['title']}";
        $mail->Body = $message;

        // Ajout des pièces jointes si présentes

        if ($_FILES['inputLettre']['tmp_name'] && $_FILES['inputLettre']['error'] == 0) {
            $mail->addAttachment($_FILES['inputLettre']['tmp_name'], $_FILES['inputLettre']['name']);
        }

        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ];

        $mail->send();

        echo "<div class='alert alert-success text-center'>Votre candidature a été envoyée avec succès!</div>";
        echo '<meta http-equiv="refresh" content="1;url=/offers.php">';
    } catch (Exception $e) {
        echo "<div class='alert alert-danger text-center'>Erreur : {$mail->ErrorInfo}</div>";
    }
}
