<?php

require_once dirname(__DIR__) . '/config/render.php';
require_once dirname(__DIR__) . '/models/Offer.php';
require_once dirname(__DIR__) . '/includes/traitement_formulaire_postule.php';

class OfferController
{

    public function index()
    {

        $offerModel = new Offer();
        $offers = $offerModel->findAll();
        // var_dump($offers);

        render('offers', [
            "offers" => $offers,
            "title" => "Offres Emploi"
        ]);
    }

    public function deleteOffer($id)
    {
        $offerModel = new Offer();
        $offerModel->deleteById($id);

        header("Location: /dashboard_company");
        exit;
    }

    public function last3Offers()
    {

        $offerModel = new Offer();
        $offers = $offerModel->findOffersByLimit(3);

        render('accueil', [
            "offers3" => $offers,
            "title" => "3 Dernières Offres"
        ]);
    }

    public function show($id)
    {
        $offerModel = new Offer();
        $offer = $offerModel->findOfferById($id);

        if (!$offer) {
            die("Offre introuvable !");
        }

        render('offerDetails', [
            "title" => "Détails de l'offre",
            "offer" => $offer,
        ]);
    }

    public function updateOffers($POST)
    {
        if (
            !empty($POST['inputTitre']) &&
            !empty($POST['inputDescription']) &&
            !empty($POST['inputMission']) &&
            !empty($POST['inputAdresse']) &&
            !empty($POST['inputPoste']) &&
            !empty($POST['inputContrat']) &&
            !empty($POST['inputTechnologie']) &&
            !empty($POST['inputPositif']) &&
            is_numeric($POST['inputNombreParticipant']) && // ← ici : 0 est "vide" pour empty() donc faut changer sa ! mettre is_numeric qui sert a retourner true si la valeur est un nombre
            !empty($POST['inputDateCreation']) &&
            !empty($POST['inputImage'])
        ) {
            try {
                $offer = new Offer();

                $offer->setTitle($POST['inputTitre']);
                $offer->setDescription($POST['inputDescription']);
                $offer->setMission($POST['inputMission']);
                $offer->setLocation($POST['inputAdresse']);
                $offer->setCategory($POST['inputPoste']);
                $offer->setParticipants_count((int) $POST['inputNombreParticipant']);
                $offer->setEmployment_type_id((int) $POST['inputContrat']);
                $offer->setTechnologies($POST['inputTechnologie']);
                $offer->setBenefits($POST['inputPositif']);
                $offer->setCreated_at($POST['inputDateCreation']);
                $offer->setImage_url($POST['inputImage']);

                $offer->updateOfferInDB($POST);

                header("Location: /dashboard_company?success=1");
                exit;
            } catch (PDOException $e) {
                echo "Erreur BDD : " . $e->getMessage();
            }
        } else {
            echo "Veuillez remplir tous les champs requis.";
        }
    }

    public function updateOffersForm($id)
    {

        $chooseContrat = new Offer();
        $contrat = $chooseContrat->chooseContrat();

        $updateById = new Offer();
        $row = $updateById->UpdateOffer($id);

        render('updateOffer', [
            "contrat" => $contrat,
            "row" => $row,
            "title" => "Offres Modif"
        ]);
    }

    public function readApply($id)
    {
        // Sécurité : forcer en entier
        $id = (int) $id;

        if (!$id) {
            die("ID de l'offre manquant !");
        }

        $offerModel = new Offer();
        $offer = $offerModel->findOfferById($id);

        if (!$offer) {
            die("Offre introuvable !");
        }

        render('postuler', [
            "title" => "Postuler Offre",
            "offer" => $offer
        ]);
    }

    public function apply($id)
    {
        sendEmail($id);
    }

    public function addOffers()
    {
        // Vérification basique des champs requis
        if (
            !empty($_POST['inputTitre']) &&
            !empty($_POST['inputDescription']) &&
            !empty($_POST['inputMission']) &&
            !empty($_POST['inputAdresse']) &&
            !empty($_POST['inputPoste']) &&
            !empty($_POST['inputEntreprise']) &&
            !empty($_POST['inputContrat']) &&
            !empty($_POST['inputTechnologie']) &&
            !empty($_POST['inputPositif']) &&
            !empty($_POST['inputDateCreation']) &&
            !empty($_POST['inputImage'])
        ) {
            try {
                $offer = new Offer();

                $offer->setTitle($_POST['inputTitre']);
                $offer->setDescription($_POST['inputDescription']);
                $offer->setMission($_POST['inputMission']);
                $offer->setLocation($_POST['inputAdresse']);
                $offer->setCategory($_POST['inputPoste']);
                $offer->setId_company((int) $_POST['inputEntreprise']);
                $offer->setEmployment_type_id((int) $_POST['inputContrat']);
                $offer->setTechnologies($_POST['inputTechnologie']);
                $offer->setBenefits($_POST['inputPositif']);
                $offer->setCreated_at($_POST['inputDateCreation']);
                $offer->setImage_url($_POST['inputImage']);

                if ($offer->addOffers()) {
                    // Redirection vers la liste des offres
                    header("Location: /offers");
                    exit;
                } else {
                    echo "Erreur lors de l'ajout de l'offre.";
                }
            } catch (PDOException $e) {
                echo "Erreur BDD : " . $e->getMessage();
            }
        } else {
            echo "Veuillez remplir tous les champs requis.";
        }
    }

    public function addOffersForm()
    {
        $offerModel = new Offer();
        $NameCompany = $offerModel->chooseEntreprise();

        $contrat = $offerModel->chooseContrat();

        // Affichage du formulaire (GET)
        // Ne pas oublier de passer $NameCompany et $contrat ici si besoin
        render('addOffers', [
            "NameCompany" => $NameCompany,
            "contrat" => $contrat,
            "title" => "Ajout d'Offre"
        ]);
    }

    public function showCompanyOffers($id)
    {

        $offerModel = new Offer();

        $company = $offerModel->readOfferCompany($id);         // Détail de l’entreprise (via $_GET['id'])
        $offers = $offerModel->offerDetailCompany($id);   // Offres de l’entreprise

        // if (!$company) {
        //     die("❌ Entreprise introuvable !");
        // }

        // if (empty($offers)) {
        //     die("⚠️ Aucune offre trouvée pour l'entreprise ID $id");
        // }

        render('OfferCompany', [
            "company" => $company,
            "offers" => $offers,
            "title" => "Offres de l’entreprise"
        ]);
    }
}
