<?php
require_once dirname(__DIR__) . '/config/render.php';
require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/models/Request.php';

class HomeController
{

    public function index()
    {

        render('connexion', [

            "title" => "Connexion / Inscription",
        ]);
    }

    public function indexOne()
    {

        render('homepage', [

            "title" => "Accueil",
        ]);
    }

    public function indexRequest($pdo)
    {
        $requestModel = new Request();
        $requests = $requestModel->getAll($pdo);

        render('request', [
            "requests" => $requests,
            "title" => "Demandes",
        ]);
    }

    public function addRequest($pdo)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Vérification basique des champs requis
            if (
                !empty($_POST['inputTitre']) &&
                !empty($_POST['inputDescription']) &&
                !empty($_POST['inputType'])
            ) {
                $requests = new Request();

                $requests->setTitle($_POST['inputTitre']);
                $requests->setDescription($_POST['inputDescription']);
                $requests->setType($_POST['inputType']);

                $requests->setStatus('en_cours'); // respecte bien l'énum exact défini dans ma BDD
                $requests->setCreated_at(date('Y-m-d H:i:s'));

                // j'attribue selon le rôle en session
                $role = $_SESSION['new_role'] ?? null;
                $id = $_SESSION['new_id'] ?? null;

                if ($role === 'client') {
                    $requests->setUser_id($id);
                    $requests->setCompany_id(null);
                } elseif ($role === 'company') {
                    $requests->setCompany_id($id);
                    $requests->setUser_id(null);
                } else {
                    // Cas admin : on laisse les IDs null
                    $requests->setUser_id(null);
                    $requests->setCompany_id(null);
                }

                if ($requests->addRequest($pdo)) {
                    header("Location: /request.php");
                    exit;
                } else {
                    echo "Erreur lors de l'ajout de la demande (requête SQL échouée). ";
                }
            } else {
                echo "Veuillez remplir tous les champs requis.";
            }
        }

        render('addRequest', [
            "title" => "Ajout de demande"
        ]);
    }
}
