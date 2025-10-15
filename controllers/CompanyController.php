<?php

require_once dirname(__DIR__) . '/config/render.php';
require_once dirname(__DIR__) . '/models/Company.php';
require_once dirname(__DIR__) . '/models/User.php';
require_once dirname(__DIR__) . '/models/Offer.php';
require_once dirname(__DIR__) . '/includes/traitement_formulaire_sendMail.php';

class CompanyController
{

    public function index()
    {
        $companyModel = new Company();
        $company = $companyModel->findAll();

        render('company', [
            "company" => $company,
            "title" => "Compagnies"
        ]);
    }

    public function indexAll()
    {
        $userModel = new User();
        $users = $userModel->findAll();

        $offerModel = new Offer();
        $offers = $offerModel->findAll();

        $companyModel = new Company();
        $companys  = $companyModel->findAll();

        render('dashboard', [
            "users" => $users,
            "offers" => $offers,
            "companys" => $companys,
            "title" => "Dashboard complet"
        ]);
    }

    public function deleteCompany($id)
    {
        $companyModel = new Company();
        $companyModel->deleteById($id);

        header("Location: /company");
        exit;
    }

    public function show($id)
    {
        $companyById = new Company();
        $company = $companyById->findById($id);

        // var_dump($id);       // ← on devrait voir un int (par ex : int(1))
        // var_dump($company);  // ← ici on devrait voir un tableau ou false
        // die();

        render('companyDetails', [
            "company" => $company,
            "title" => "Détails Entreprise"
        ]);
    }

    public function showOfferById($userId)
    {
        $companyModel = new Company();


        // on recup l'id de la company liée à cet users
        $companyId = $companyModel->getCompanyIdByUserId($userId);

        if (!$companyId) {
            echo "⚠️ Aucun company_id trouvé pour cet utilisateur.";
            return;
        }

        // on recup les offres de la company
        $offers = $companyModel->findOffersByCompanyId($companyId);

        render('dashboard_company', [
            "offers_company" => $offers,
            "title" => "Dashboard Company"
        ]);
    }

    public function updateCompanys($POST)
    {
        if (
            !empty($POST['inputNom']) &&
            !empty($POST['inputNbEmploye']) &&
            !empty($POST['inputDomaine']) &&
            !empty($POST['inputAdresse']) &&
            !empty($POST['inputLatitude']) &&
            !empty($POST['inputLongitude']) &&
            !empty($POST['inputDescription']) &&
            !empty($POST['inputSiret']) &&
            !empty($POST['inputLogo'])
        ) {
            try {
                $company = new Company();

                $company->setName($POST['inputNom']);
                $company->setNumber_of_employees($POST['inputNbEmploye']);
                $company->setIndustry($POST['inputDomaine']);
                $company->setAdress($POST['inputAdresse']);
                $company->setLatitude($POST['inputLatitude']);
                $company->setLongitude($POST['inputLongitude']);
                $company->setDescription($POST['inputDescription']);
                $company->setNSiret($POST['inputSiret']);
                $company->setLogo($POST['inputLogo']);

                $company->updateCompanyInDB($POST);

                header("Location: /company?success=1");
                exit;
            } catch (PDOException $e) {
                echo "Erreur BDD : " . $e->getMessage();
            }
        } else {
            echo "Veuillez remplir tous les champs requis.";
        }
    }

    public function updateCompanyForm($id)
    {

        $updateById = new Company();
        $row = $updateById->UpdateCompany($id);

        render('updateCompany', [
            "row" => $row,
            "title" => "Société Modif"
        ]);
    }

    private function genererMotDePasse($longueur = 8)
    {
        // Ensemble de caractères possibles
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $motDePasse = '';
        $max = strlen($caracteres) - 1;
        // str pour string leng pour longueur

        // Boucle pour générer chaque caractère aléatoire
        for ($i = 0; $i < $longueur; $i++) {
            $index = rand(0, $max); // Choisir un index aléatoire
            $motDePasse .= $caracteres[$index];
        }

        // return password_hash($motDePasse, PASSWORD_DEFAULT);
        return $motDePasse;
        // strtoupper() sert a changer de mini en maju
    }

    public function addCompanys()
    {
        // Vérification des champs requis
        if (
            !empty($_POST['inputNom']) &&
            !empty($_POST['inputNbEmploye']) &&
            !empty($_POST['inputEmail']) &&
            !empty($_POST['inputDomaine']) &&
            !empty($_POST['inputAdresse']) &&
            !empty($_POST['inputLatitutde']) &&
            !empty($_POST['inputLongitude']) &&
            !empty($_POST['inputDescription']) &&
            !empty($_POST['inputSiret']) &&
            !empty($_POST['inputLogo'])
        ) {
            try {
                $company = new Company();

                $company->setName($_POST['inputNom']);
                $company->setNumber_of_employees($_POST['inputNbEmploye']);
                $company->setIndustry($_POST['inputDomaine']);
                $company->setEmail($_POST['inputEmail']);
                $company->setAdress($_POST['inputAdresse']);
                $company->setLatitude($_POST['inputLatitutde']);
                $company->setLongitude($_POST['inputLongitude']);
                $company->setDescription($_POST['inputDescription']);
                $company->setNSiret($_POST['inputSiret']);
                $company->setLogo($_POST['inputLogo']);

                // var_dump($email);
                // var_dump($password);
                // die;

                $companyId = $company->addCompanys();

                // var_dump($companyId);
                // die;

                $user = new User();

                $nom = $_POST['inputNom'];
                // Remplacer les espaces par des underscores
                $nom = str_replace(' ', '_', $nom);
                // Creation de l'email
                $email = $nom . '@company.com';
                $password = $this->genererMotDePasse(8);

                $user->setNom($_POST['inputFirstName']);
                $user->setPrenom($_POST['inputLastName']);
                $user->setEmail($email);
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $user->setRole("company");
                $user->setTelephone($_POST['inputTelephone']);
                $user->setVille($_POST['inputVille']);
                $user->setCodePostal($_POST['inputZipcode']);
                $user->setPhoto($_POST['inputPhoto']);
                $user->setCvPdf(null);
                $user->setQualification("Gerant");
                $user->setPreference(null);
                $user->setDisponibilite(0);

                // créer l'user avec le mail et son mdp ci dessus afin de l'ajt dans la table users
                $newUser = $user->addUsers($companyId);

                // reussir a lui affilier l'id de company , et l'inscire dans la table users dans la colonne company_id !!

                echo "Email destinataire: " . $_POST['inputEmail'] . "<br>";
                echo "Login généré: " . $email . "<br>";
                echo "Password généré: " . $password . "<br>";
                // die(); // Arrêter ici pour voir les valeurs

                // une fois le user ajt en bdd dans la table user,
                // je lui envoi par mail qui ma transmis dans son form de addCompanys son mail et mdp de connexion
                // sendEmail qui se trouve dans includes, s'occupe de lenvoi du mail et mdp 
                sendMail($_POST['inputEmail'], $email, $password);

                if ($companyId && $newUser) {
                    // Redirection vers la connexion
                    header("Location: /connexion");
                    exit;
                } else {
                    echo "Erreur lors de l'ajout de la société.";
                }
            } catch (PDOException $e) {
                echo "Erreur BDD : " . $e->getMessage();
            }
        } else {
            echo "Veuillez remplir tous les champs requis.";
        }
    }

    public function addCompanyForm()
    {
        // Affichage du formulaire (GET)
        render('newCompany', [
            "title" => "Ajout de Société"
        ]);
    }

    public function readApplyCompany()
    {

        render('newCompany', [
            "title" => "Postuler Société"
        ]);
    }

    public function toggleStatus()
    {
        if (!empty($_POST['id']) && isset($_POST['current_status'])) {
            $id = (int)$_POST['id'];
            $currentStatus = $_POST['current_status'];

            // Bascule entre "Pending" et "Done"
            $newStatus = ($currentStatus === 'Pending') ? 'Done' : 'Pending';

            $requestModel = new Company();
            $requestModel->updateStatus($id, $newStatus);
        }

        header("Location: /dashboard");
        exit;
    }
}
