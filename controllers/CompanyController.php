<?php

require_once dirname(__DIR__) . '/config/render.php';
require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/models/Companys.php';
require_once dirname(__DIR__) . '/models/Users.php';
require_once dirname(__DIR__) . '/models/Offer.php';

class CompanyController
{

    public function indexAll($pdo)
    {
        $userModel = new Users();
        $users = $userModel->findAll($pdo);

        $offerModel = new Offer();
        $offers = $offerModel->findAll($pdo);

        $companyModel = new Company();
        $companys  = $companyModel->findAll($pdo);

        render('dashboard', [
            "users" => $users,
            "offers" => $offers,
            "companys" => $companys,
            "title" => "Dashboard complet"
        ]);
    }


    public function index($pdo)
    {
        $companyModel = new Company();
        $company = $companyModel->findAll($pdo);

        render('company', [
            "company" => $company,
            "title" => "Compagnies"
        ]);
    }

    public function show($pdo, $id)
    {
        $companyById = new Company();
        $company = $companyById->findById($pdo, $id);

        render('companyDetails', [
            "company" => $company,
            "title" => "Détails Entreprise"
        ]);
    }

    public function update($pdo)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['myid'])) {

            $company = new Company();
            $company->updateCompanyInDB($pdo, $_POST);

            // Pop-up JS + redirection gérés dans la vue (pas de header ici)
            echo "<script>
                alert('✅ Entreprise mise à jour avec succès.');
                window.location.href = 'company.php';
            </script>";
            exit();
        }

        $companyModel = new Company();
        $row = $companyModel->UpdateCompany($pdo);

        render('updateCompany', [ // attention : adapter le nom de la vue ici si différent
            "row" => $row,
            "title" => "Modifier l’entreprise"
        ]);
    }

    public function addCompany($pdo)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérification des champs requis
            if (
                !empty($_POST['inputNom']) &&
                !empty($_POST['inputNbEmploye']) &&
                !empty($_POST['inputDomaine']) &&
                !empty($_POST['inputAdresse']) &&
                !empty($_POST['inputLatitutde']) &&
                !empty($_POST['inputLongitude']) &&
                !empty($_POST['inputDescription']) &&
                !empty($_POST['inputSiret']) &&
                !empty($_POST['inputLogo'])
            ) {
                $company = new Company();
                $company->addCompany($pdo);

                echo "<script>
                    alert('✅ Entreprise ajoutée avec succès.');
                    window.location.href = 'company.php';
                </script>";
                exit;
            } else {
                echo "Veuillez remplir tous les champs requis.";
            }
        }

        render('addCompany', [
            "title" => "Ajout Entreprise"
        ]);
    }

    public function postulerCompany()
    {

        render('newCompany', [

            "title" => "Ajout Entreprise",
        ]);
    }
}
