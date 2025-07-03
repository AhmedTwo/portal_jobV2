<?php

require_once dirname(__DIR__) . '/config/render.php';
require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/models/Offer.php';

class OfferController
{

    public function index($pdo)
    {

        $offerModel = new Offer();

        $offers = $offerModel->findAll($pdo);
        // var_dump($offers);

        render('offers', [
            "offers" => $offers,
            "title" => "Offres Emploi"
        ]);
    }

    public function index3($pdo)
    {

        $offerModel = new Offer();

        $offers = $offerModel->find3($pdo);

        render('accueil', [
            "offers3" => $offers,
            "title" => "3 Dernières Offres"
        ]);
    }

    public function show($pdo, $id)
    {

        $offerById = new Offer();
        $offers = $offerById->findById($pdo, $id);

        render('offerDetails', [
            "offers" => $offers,
            "title" => "Offres Détails"
        ]);
    }

    public function update($pdo)
    {

        $chooseContrat = new Offer();
        $contrat = $chooseContrat->chooseContrat($pdo);

        $updateById = new Offer();
        $row = $updateById->UpdateOffer($pdo);

        render('updateOffer', [
            "contrat" => $contrat,
            "row" => $row,
            "title" => "Offres Modif"
        ]);
    }

    public function postuler()
    {

        render('postuler', [

            "title" => "Postuler",
        ]);
    }

    public function addOffers($pdo)
    {

        $chooseEntreprise = new Offer();
        $NameComapany = $chooseEntreprise->chooseEntreprise($pdo);

        $chooseContrat = new Offer();
        $contrat = $chooseContrat->chooseContrat($pdo);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

                if ($offer->addOffers($pdo)) {
                    // Redirection vers la liste des offres
                    header("Location: /offers.php");
                    exit;
                } else {
                    echo "Erreur lors de l'ajout de l'offre.";
                }
            } else {
                echo "Veuillez remplir tous les champs requis.";
            }
        }

        // Ne pas oublier de passer $NameComapany et $contrat ici si besoin
        render('addOffers', [
            "NameComapany" => $NameComapany,
            "contrat" => $contrat,
            "title" => "Ajout d'Offre"
        ]);
    }

    public function showCompanyOffers($pdo, $id)
    {

        $offerModel = new Offer();

        $company = $offerModel->readOfferCompany($pdo);         // Détail de l’entreprise (via $_GET['id'])
        $offers = $offerModel->offerDetailCompany($pdo, $id);   // Offres de l’entreprise

        render('OfferCompany', [
            "company" => $company,
            "offers" => $offers,
            "title" => "Offres de l’entreprise"
        ]);
    }
}
