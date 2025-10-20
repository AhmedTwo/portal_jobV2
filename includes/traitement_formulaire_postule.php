<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/models/Offer.php';
require_once dirname(__DIR__) . '/models/User.php';
require_once dirname(__DIR__) . '/models/Company.php';

function sendEmail(int $id): void
{
    if (!isset($_SESSION['new_id'])) {
        die('Vous devez être connecté pour postuler.');
    }

    $user_id = (int) $_SESSION['new_id'];

    $offerModel = new Offer();
    $offerApply = $offerModel->offerApply($id);

    // var_dump($offerApply);
    // exit;

    $userModel = new User();
    $userApply = $userModel->readProfil($user_id);

    if (!$offerApply || !$userApply) {
        die("Erreur lors de la récupération des données !");
    }

    // 🔸 On récupère ici l’email de la company depuis l’offre
    $companyModel = new Company();
    $company = $companyModel->findById($offerApply['id_company']);

    $companyEmail = $company['email_company'] ?? null;

    if (!$companyEmail) {
        die("Email de l'entreprise introuvable !");
    }

    // Gestion du fichier uploadé
    $cv_file = $userApply['cv_pdf'] ?? 'Non fourni';

    $messageExpediteur = "
            Bonjour {$userApply['nom']} {$userApply['prenom']},

            Votre candidature à l'offre suivante : {$offerApply['title']} a été envoyé à 
            Entreprise : {$offerApply['company_name']}

            Les informations transmises :
            NOM : {$userApply['nom']}
            PRÉNOM : {$userApply['prenom']}
            VILLE : {$userApply['ville']}
            CODE POSTAL : {$userApply['code_postal']}
            TÉLÉPHONE : {$userApply['telephone']}
            EMAIL : {$userApply['email']}

            LETTRE DE MOTIVATION ÉCRITE :
            {$_POST['inputMotivation']}

            CV : {$cv_file}

            Notre équipe Portal_Job étudiera attentivement votre dossier.

            Cordialement,
            L'équipe Portal_Job
            ";

    $messageCompany =
        "
                Bonjour {$company['name']},

                Le candidat {$userApply['nom']} {$userApply['prenom']} a postulé à votre offre : {$offerApply['title']}.

                Informations le concernant :

                NOM : {$userApply['nom']}
                PRÉNOM : {$userApply['prenom']}
                VILLE : {$userApply['ville']}
                CODE POSTAL : {$userApply['code_postal']}
                TÉLÉPHONE : {$userApply['telephone']}
                EMAIL : {$userApply['email']}

                LETTRE DE MOTIVATION ÉCRITE :
                {$_POST['inputMotivation']}

                CV : {$cv_file}

                Cordialement,
                L'équipe Portal_Job
            ";

    $mailExp = new PHPMailer(true); // envoi du mail a celui qui est co
    try {
        $mailExp->isSMTP();
        $mailExp->Host = 'smtp.gmail.com';
        $mailExp->SMTPAuth = true;
        $mailExp->Username = 'seghiriahmed9@gmail.com';
        $mailExp->Password = 'nbjplfluxfyrjken'; // mot de passe d’application Gmail
        $mailExp->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mailExp->Port = 465;
        $mailExp->CharSet = 'UTF-8';
        $mailExp->Encoding = 'base64';

        $mailExp->setFrom($userApply['email'], $userApply['nom'] . ' ' . $userApply['prenom']);
        $mailExp->addAddress($_SESSION['new_email']); // destinataire : utilisateur
        $mailExp->Subject = "Votre candidature pour l'offre : {$offerApply['title']}";
        $mailExp->Body = $messageExpediteur;

        // ✅ Ajouter le CV en pièce jointe si présent
        if (!empty($userApply['cv_pdf']) && file_exists(__DIR__ . '/../uploads/cv/' . $userApply['cv_pdf'])) {
            $mailExp->addAttachment(__DIR__ . '/../uploads/cv/' . $userApply['cv_pdf'], 'CV_' . $userApply['nom'] . '.pdf');
        }
        // file_exists() vérifie que le fichier existe réellement sur ton serveur.
        // addAttachment() permet de joindre le fichier au mail. Le deuxième paramètre est le nom sous lequel il apparaîtra pour le destinataire.

        $mailExp->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ];

        $mailExp->send();
        echo '<meta http-equiv="refresh" content="0;url=/offers">';
    } catch (Exception $e) {
        echo "<div class='alert alert-danger text-center'>Erreur mail utilisateur : {$mailExp->ErrorInfo}</div>";
    }

    $mailCompany = new PHPMailer(true);  // envoi du mail à la company selon son id/email
    try {
        $mailCompany->isSMTP();
        $mailCompany->Host = 'smtp.gmail.com';
        $mailCompany->SMTPAuth = true;
        $mailCompany->Username = 'seghiriahmed9@gmail.com';
        $mailCompany->Password = 'nbjplfluxfyrjken'; // mot de passe d’application Gmail
        $mailCompany->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mailCompany->Port = 465;
        $mailCompany->CharSet = 'UTF-8';
        $mailCompany->Encoding = 'base64';

        $mailCompany->setFrom($userApply['email'], $userApply['nom'] . ' ' . $userApply['prenom']);
        $mailCompany->addAddress($companyEmail); // destinataire : company
        $mailCompany->Subject = "Nouvelle candidature pour votre offre : {$offerApply['title']}";
        $mailCompany->Body = $messageCompany;

        // Ajouter le CV en pièce jointe si présent
        if (!empty($userApply['cv_pdf']) && file_exists(__DIR__ . '/../uploads/cv/' . $userApply['cv_pdf'])) {
            $mailCompany->addAttachment(__DIR__ . '/../uploads/cv/' . $userApply['cv_pdf'], 'CV_' . $userApply['nom'] . '.pdf');
        }
        // file_exists() vérifie que le fichier existe réellement sur ton serveur.
        // addAttachment() permet de joindre le fichier au mail. Le deuxième paramètre est le nom sous lequel il apparaîtra pour le destinataire.

        $mailCompany->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ];

        $offerModel->incrementParticipant($id);

        $mailCompany->send();
        echo '<meta http-equiv="refresh" content="0;url=/offers">';
    } catch (Exception $e) {
        echo "<div class='alert alert-danger text-center'>Erreur mail utilisateur : {$mailCompany->ErrorInfo}</div>";
    }
}
