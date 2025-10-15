<?php
require_once dirname(__DIR__) . '/config/render.php';
require_once dirname(__DIR__) . '/models/Request.php';

class HomeController
{

    public function index()
    {
        render('connexion', [

            "title" => "Connexion",
        ]);
    }

    public function indexOne()
    {
        $userModel = new User();
        $users = $userModel->findAll();
        $usersCount = count($users);

        $offerModel = new Offer();
        $offers = $offerModel->findAll();
        $offersCount = count($offers);
        $LastOffers3 = $offerModel->findOffersByLimit(3); // je lui indique son param, qui est le nombre de limit que je veux afficher

        $companyModel = new Company();
        $companys  = $companyModel->findAll();
        $companysCount = count($companys);

        render('homepage', [
            "LastOffers3" => $LastOffers3,
            "usersCount" => $usersCount,
            "offersCount" => $offersCount,
            "companysCount" => $companysCount,
            "title" => "Accueil",
        ]);
    }

    public function indexRequest()
    {
        $requestModel = new Request();
        $requests = $requestModel->getAll();

        render('request', [
            "requests" => $requests,
            "title" => "Demandes",
        ]);
    }

    public function requestById($id)
    {
        $requestModel = new Request();
        $requests = $requestModel->getById($id);

        render('myRequest', [
            "requests" => $requests,
            "title" => "Mes Demandes",
        ]);
    }

    public function addRequest()
    {
        // Vérification des champs requis
        if (
            !empty($_POST['inputTitre']) &&
            !empty($_POST['inputDescription']) &&
            !empty($_POST['inputType'])
        ) {
            try {
                $request = new Request();

                // Récupération des valeurs du formulaire
                $request->setTitle($_POST['inputTitre']);
                $request->setDescription($_POST['inputDescription']);
                $request->setType($_POST['inputType']);

                // Statut par défaut
                $request->setStatus('EN_COURS');

                // Date de création à maintenant
                $request->setCreated_at(date('Y-m-d H:i:s'));

                // var_dump($_SESSION);
                // die;

                if (isset($_SESSION['new_id'])) {
                    $request->setUser_id($_SESSION['new_id']);
                } else {
                    echo "Erreur : utilisateur non connecté.";
                    echo '<meta http-equiv="refresh" content="2;url=/request">';
                    return;
                }

                // Ajout de la demande
                if ($request->addRequest()) {
                    header("Location: /request");
                    exit;
                } else {
                    echo "Erreur lors de l'ajout de la demande.";
                }
            } catch (PDOException $e) {
                echo "Erreur BDD : " . $e->getMessage();
            }
        } else {
            echo "Veuillez remplir tous les champs requis.";
        }
    }

    public function addMyRequest()
    {
        // Vérification des champs requis
        if (
            !empty($_POST['inputTitre']) &&
            !empty($_POST['inputDescription']) &&
            !empty($_POST['inputType'])
        ) {
            try {
                $request = new Request();

                // Récupération des valeurs du formulaire
                $request->setTitle($_POST['inputTitre']);
                $request->setDescription($_POST['inputDescription']);
                $request->setType($_POST['inputType']);

                // Statut par défaut
                $request->setStatus('EN_COURS');

                // Date de création à maintenant
                $request->setCreated_at(date('Y-m-d H:i:s'));

                // var_dump($_SESSION);
                // die;

                if (isset($_SESSION['new_id'])) {
                    $request->setUser_id($_SESSION['new_id']);
                } else {
                    echo "Erreur : utilisateur non connecté.";
                    echo '<meta http-equiv="refresh" content="2;url=/request">';
                    return;
                }

                // Ajout de la demande
                if ($request->addRequest()) {
                    header("Location: /myRequest");
                    exit;
                } else {
                    echo "Erreur lors de l'ajout de la demande.";
                }
            } catch (PDOException $e) {
                echo "Erreur BDD : " . $e->getMessage();
            }
        } else {
            echo "Veuillez remplir tous les champs requis.";
        }
    }

    public function addRequestForm($type = 'request')
    {

        // Affichage du formulaire (GET)
        render('addRequest', [
            "title" => "Ajout d'une demande",
            "type" => $type
        ]);
    }

    public function deleteRequest($id)
    {
        $requestModel = new Request();
        $requestModel->deleteById($id);

        header("Location: /request");
        exit;
    }

    public function deleteMyRequest($id)
    {
        $requestModel = new Request();
        $requestModel->deleteById($id);

        header("Location: /myRequest");
        exit;
    }

    public function toggleStatusMyRequest()
    {
        if (!empty($_POST['id']) && isset($_POST['current_status'])) {
            $id = (int)$_POST['id'];
            $currentStatus = $_POST['current_status'];

            // Bascule entre "en_cours" et "FINALISEE"
            $newStatus = ($currentStatus === 'FINALISEE') ? 'EN_COURS' : 'FINALISEE';

            $requestModel = new Request();
            $requestModel->updateStatus($id, $newStatus);
        }

        header("Location: /myRequest");
        exit;
    }

    public function toggleStatus()
    {
        if (!empty($_POST['id']) && isset($_POST['current_status'])) {
            $id = (int)$_POST['id'];
            $currentStatus = $_POST['current_status'];

            // Bascule entre "en_cours" et "FINALISEE"
            $newStatus = ($currentStatus === 'FINALISEE') ? 'EN_COURS' : 'FINALISEE';

            $requestModel = new Request();
            $requestModel->updateStatus($id, $newStatus);
        }

        header("Location: /request");
        exit;
    }
}
