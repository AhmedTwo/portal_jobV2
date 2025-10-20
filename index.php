<?php

session_start();

$activePage = null; // en lien avec le header !

// Récupère le rôle de l'utilisateur stocké en session si disponible,
// sinon assigne "null" par défaut (utile si aucun rôle n'a encore été défini)
$role = $_SESSION['new_role'] ?? null;

require_once 'controllers/HomeController.php';
require_once 'controllers/CompanyController.php';
require_once 'controllers/OfferController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/FavorisController.php';
require_once 'controllers/RequestController.php';

// Récupère la méthode HTTP utilisée (GET, POST, etc.)
$methode = $_SERVER['REQUEST_METHOD'];

// Récupère uniquement le chemin de l'URL (par exemple : /contact)
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// parse_url est une fonction PHP qui analyse une URL et peut en extraire différentes parties
// PHP_URL_PATH est une constante qui indique qu’on souhaite récupérer uniquement le chemin (c’est-à-dire sans les paramètres ?)

$segment = explode("/", trim($uri, "/"));
// explode decoupe la chaine en un tableau en utilisant le / comme séparateur
// trim supprime tous les / en debut et en fin de la chaine $uri qu'on lui a passé

if ($segment[0] == "") {

    if ($methode == "GET") {
        $homeController = new HomeController;
        $homeController->indexOne();
        return;
    }
}

if ($segment[0] == "connexion") {
    $activePage = "connexion";

    // Gestion du cas /connexion/applyCompany
    if (isset($segment[1]) && $segment[1] == "applyCompany") {

        if ($methode == "POST") {
            // var_dump($_POST);
            // die;

            try {
                $controller = new CompanyController;
                $controller->addCompanys(); // ← envoie de la demande d'ajout a l'admin sur son dashboard
                return;
            } catch (PDOException $e) {
                echo json_encode([
                    "message" => "Échec d'envoi de la demande d'ajout de société",
                    "data" => $e->getMessage()
                ]);
                return;
            }
        }

        if ($methode == "GET") {
            $controller = new CompanyController;
            $controller->readApplyCompany();
            return;
        }
    }

    // cas ou mdp oublié
    if (isset($segment[1]) && $segment[1] == "passwordForget") {

        // Si on est dans le cas mdp oublié alors faire parvenir le mdp par mail à l'adresse indique qui doit bien sur existé en bdd 
        if ($methode == "POST") {
            $userController = new UserController;
            $userController->sendEmail();
            // recharger la même page pour afficher les messages
            $userController->passwordForget();
            return;
        }

        if ($methode == 'GET') {
            $userController = new UserController;
            $userController->passwordForget();
            return;
        }
    }

    // Si c'est juste /connexion en POST → login
    if ($methode == "POST") {
        $userController = new UserController;
        $userController->login();
        return;
    }

    // Sinon GET → affichage page de connexion
    if ($methode == "GET") {
        $homeController = new HomeController;
        $homeController->index();
        return;
    }
}

if ($segment[0] == "inscription") {
    $activePage = "inscription";

    if (isset($segment[1]) && $segment[1] === "addUser") {

        $UserController = new UserController();

        if ($methode === "GET") {
            $UserController->addUserForm();  // affiche le formulaire
            return;
        }

        if ($methode === "POST") {
            $UserController->addUsers(); // traite le formulaire
            return;
        }
    }
}

if ($segment[0] == "accueil") {
    $activePage = "accueil";

    if (isset($segment[1]) && $segment[1] == "apply") {

        // Récupère l'ID de l'offre depuis l'URL ou les paramètres GET
        // Exemple : accueil/apply?id=12
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

        // Cas où la requête est en GET : on affiche le formulaire de candidature
        if ($methode == "GET") {
            $OfferController = new OfferController; // on fait appel au controller des offres
            $OfferController->readApply($id); // ici on fait donc appel a sa fonction
            return; // On stoppe l'exécution après avoir affiché
        }

        // Cas où la requête est en POST : on traite l'envoi de la candidature
        if ($methode == "POST") {

            // Vérifie qu'un ID d'offre est bien fourni
            if (!$id) {
                die("ID de l'offre manquant !");
            }

            // Appel du contrôleur pour enregistrer la candidature
            $OfferController = new OfferController; // on fait appel au controller des offres
            $OfferController->apply($id); // ici on fait donc appel a sa fonction
            return; // On stoppe l'exécution après réussi l'envoi
        }
    }

    if ($methode == "GET") {

        $contactController = new OfferController();
        $contactController->last3Offers();
        return;
    }
}

if ($segment[0] == "offers") {
    // Vérifie si le premier segment de l'URL correspond à "offers"
    // Définit la page active sur "offers"
    $activePage = "offers";

    // ==============================
    // CAS 1 : "offers/offerDetails/apply"
    // ==============================
    // Vérifie si :
    // - un 3ème segment d'URL existe (ex: /offers/offerDetails/apply → $segment[2] = "apply")
    // - le 2ème segment est "offerDetails"
    // - et le 3ème segment est "apply"
    if (isset($segment[1]) && $segment[1] == "apply") {
        // Vérifie si la variable ou l'index existe ET qu'il n'est pas null.
        // Exemple : isset($segment[2]) renvoie true seulement si $segment[2] est défini et contient une valeur différente de null (évite les erreurs "Undefined index").

        // Récupère l'ID de l'offre depuis l'URL ou les paramètres GET
        // Exemple : offers/offerDetails/apply?id=12
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

        // Cas où la requête est en GET : on affiche le formulaire de candidature
        if ($methode == "GET") {
            $OfferController = new OfferController; // on fait appel au controller des offres
            $OfferController->readApply($id); // ici on fait donc appel a sa fonction
            return; // On stoppe l'exécution après avoir affiché
        }

        // Cas où la requête est en POST : on traite l'envoi de la candidature
        if ($methode == "POST") {

            // Vérifie qu'un ID d'offre est bien fourni
            if (!$id) {
                die("ID de l'offre manquant !");
            }

            // Appel du contrôleur pour enregistrer la candidature
            $OfferController = new OfferController; // on fait appel au controller des offres
            $OfferController->apply($id); // ici on fait donc appel a sa fonction
            return; // On stoppe l'exécution après réussi l'envoi
        }
    }

    // ==============================
    // CAS 2 : "offers/offerDetails/{id}"
    // ==============================
    // Exemple d'URL : offers/offerDetails/15
    // Vérifie si :
    // - la méthode utilisée est GET
    // - le 2ème segment existe
    // - et ce 2ème segment vaut "offerDetails"
    if ($methode == "GET" && isset($segment[1]) && $segment[1] == "offerDetails") {

        // On récupère l'ID passé dans l'URL (3ème segment)
        $id = (int)$segment[2];

        $offerController = new OfferController; // on instancie le controller des offres
        $offerController->show($id); // on appelle la fonction qui affiche les détails de l'offre
        return; // on stoppe ici car on a trouvé le cas correspondant
    }

    // ==============================
    // CAS 3 : "offers/addOffers"
    // ==============================
    // Exemple d'URL : offers/addOffers
    // Vérifie si :
    // - le 2ème segment existe
    // - et vaut "addOffers"
    if (isset($segment[1]) && $segment[1] === "addOffers") {

        $offerController = new OfferController(); // on instancie le controller des offres

        // Vérifie si la méthode est GET (affiche le formulaire de création)
        if ($methode === "GET") {
            $offerController->addOffersForm(); // on affiche le formulaire de création d'offre
            return; // on stoppe après avoir affiché
        }

        // Vérifie si la méthode est POST (traite la création de l'offre)
        if ($methode === "POST") {
            $offerController->addOffers(); // on traite les données envoyées et on crée l'offre
            return; // on stoppe après avoir enregistré
        }
    }

    // ==============================
    // CAS 4 : "offers/offerCompany/{id}"
    // ==============================
    // Exemple d'URL : offers/offerCompany/3
    // Vérifie si :
    // - la méthode est GET
    // - le 2ème segment existe
    // - et vaut "offerCompany"
    if ($methode == "GET" && isset($segment[1]) && $segment[1] == "offerCompany") {

        $id = (int) $segment[2]; // Récupère l'ID de la société depuis l'URL

        $controller = new OfferController; // on instancie le controller
        $controller->showCompanyOffers($id); // on appelle la fonction qui affiche toutes les offres d'une société
        return; // on stoppe car on a trouvé le cas
    }

    // ==============================
    // CAS 5 : "offers/updateOffer/{id}" (affichage formulaire)
    // ==============================
    // Exemple d'URL : offers/updateOffer/6
    // Vérifie si :
    // - la méthode est GET
    // - le 2ème segment existe
    // - et vaut "updateOffer"
    if ($methode == "GET" && isset($segment[1]) && $segment[1] == "updateOffer") {

        $id = (int)$segment[2]; // ID de l'offre à modifier récupéré depuis l'URL

        $offerController = new OfferController; // on instancie le controller
        $offerController->updateOffersForm($id); // on appelle la fonction qui affiche le formulaire pré-rempli pour modification
        return; // on stoppe après affichage
    }

    // ==============================
    // CAS 6 : "offers/updateOffer/{id}" (traitement update)
    // ==============================
    // Exemple d'URL : offers/updateOffer/6
    // Vérifie si :
    // - la méthode est POST
    // - le 2ème segment existe
    // - et vaut "updateOffer"
    if ($methode == "POST" && isset($segment[1]) && $segment[1] == "updateOffer") {

        try {
            $updateController = new OfferController; // on instancie le controller
            $updateController->updateOffers($_POST); // on appelle la fonction qui met à jour l'offre avec les données envoyées
            return; // on stoppe si tout s'est bien passé
        } catch (PDOException $e) {
            // Gestion des erreurs SQL lors de la mise à jour
            echo json_encode([
                "message" => "Échec de la modification de l'offre",
                "data" => $e->getMessage()
            ]);
            return; // on stoppe même en cas d'erreur
        }
    }

    // ==============================
    // CAS 7 : "offers/deleteOffer"
    // ==============================
    // Exemple d'URL : offers/deleteOffer (via POST avec l'id dans $_POST)
    // Vérifie si :
    // - la méthode est POST
    // - le 2ème segment existe
    // - et vaut "deleteOffer"
    if ($methode == "POST" && isset($segment[1]) && $segment[1] == "deleteOffer") {

        // Récupère l'ID envoyé via le formulaire (méthode POST)
        // - Si $_POST['id'] existe → on le convertit en entier avec (int)
        // - Sinon, si 'id' n'est pas présent dans le POST → on assigne "null"
        $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

        // Vérifie que l'ID est bien défini et supérieur à 0
        // - Cela permet d'éviter les suppressions avec un ID vide ou invalide
        if ($id) {
            $offerController = new OfferController(); // on instancie le controller des offres
            $offerController->deleteOffer($id);       // on appelle la fonction qui supprime l'offre correspondante
        }

        // Arrête l'exécution après la tentative de suppression
        // - Peu importe si l'offre a été supprimée ou non
        return;
    }

    // ==============================
    // CAS 8 : "offers" (affichage liste des offres)
    // ==============================
    // Exemple d'URL : offers/
    // Vérifie si :
    // - la méthode est GET
    if ($methode == "GET") {

        $offerController = new OfferController; // on instancie le controller
        $offerController->index(); // on appelle la fonction qui affiche toutes les offres disponibles
        return; // on stoppe après affichage
    }
}

if ($segment[0] == "company") {
    $activePage = "company";

    // Si on est dans le cas : company/companyDetails
    if ($methode == "GET" && isset($segment[1]) && $segment[1] == "companyDetails") {

        // on recup l'id et on affiche la société
        $id = (int)$segment[2];

        $CompanyController = new CompanyController;
        $CompanyController->show($id);
        return;
    }

    // Si on est dans le cas : company/updateCompany
    // Cas : Requête GET pour recup le formulaire
    if ($methode == "GET" && isset($segment[1]) && $segment[1] == "updateCompany") {

        $id = (int)$segment[2];

        $companyController = new CompanyController;
        $companyController->updateCompanyForm($id);
        return;
    }

    // Si on est dans le cas : company/updateCompany/6
    if ($methode == "POST" && isset($segment[1]) && $segment[1] == "updateCompany") {

        // var_dump($_POST);
        // die;

        try {
            $updateController = new CompanyController;
            $updateController->updateCompanys($_POST);
            return;
        } catch (PDOException $e) {
            echo json_encode(["message" => "Échec de modification de la société", "data" => $e->getMessage()]);
            return;
        }
    }

    // Cas : Requête POST pour supprimer by id / donc url = company/deleteCompany
    if ($methode == "POST" && isset($segment[1]) && $segment[1] == "deleteCompany") {

        $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

        if ($id) {
            $CompanyController = new CompanyController();
            $CompanyController->deleteCompany($id);
        }
        return;
    }

    // Cas : Requête GET pour afficher les offres
    if ($methode == "GET") {

        $companyController = new CompanyController;
        $companyController->index();
        return;
    }
}

if ($segment[0] == "dashboard") {
    $activePage = "dashboard";

    if ($methode == "POST" && isset($segment[1]) && $segment[1] == "toggleStatus") {

        // 👇 Protection d'accès
        // la variable $role est defini en haut du fichier 
        if ($role !== 'admin') {
            http_response_code(403);
            echo "Accès refusé. Vous devez être administrateur.";
            return;
        }

        // Cas : Requête POST pour finaliser une demande (changement de statut)

        $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

        if ($id) {
            $HomeController = new CompanyController;
            $HomeController->toggleStatus();
        }
        return;
    }

    // ==============================
    // CAS  : "dashboard/updateUser/{id}" (affichage formulaire)
    // ==============================
    // Exemple d'URL : dashboard/updateUser/6
    // Vérifie si :
    // - la méthode est GET
    // - le 2ème segment existe
    // - et vaut "updateUser"
    if ($methode == "GET" && isset($segment[1]) && $segment[1] == "updateUser") {

        $id = (int)$segment[2]; // ID de l'offre à modifier récupéré depuis l'URL

        $UserControllerr = new UserController; // on instancie le controller
        $UserControllerr->updateProfilFormById($id); // on appelle la fonction qui affiche le formulaire pré-rempli pour modification
        return; // on stoppe après affichage
    }

    // ==============================
    // CAS  : "dashboard/updateUser/{id}" (traitement update)
    // ==============================
    // Exemple d'URL : dashboard/updateUser/6
    // Vérifie si :
    // - la méthode est POST
    // - le 2ème segment existe
    // - et vaut "updateUser"
    if ($methode == "POST" && isset($segment[1]) && $segment[1] == "updateUser") {

        // Vérifie si le 3e segment de l’URL ($segment[2]) existe :
        // - Si OUI → le convertit en entier (avec (int)) et l’assigne à la variable $id
        // - Si NON → assigne la valeur "null" à $id
        // Exemple : pour une URL "dashboard/updateUser/6", $segment[2] = "6" → $id = 6
        $id = isset($segment[2]) ? (int) $segment[2] : null;

        if ($id) {
            try {
                $UserController = new UserController; // on instancie le controller
                $UserController->updateProfilById($id); // on appelle la fonction qui met à jour le user en question avec les données envoyées
                return; // on stoppe si tout s'est bien passé
            } catch (PDOException $e) {
                // Gestion des erreurs SQL lors de la mise à jour
                echo json_encode([
                    "message" => "Échec de la modification de l'utilisateur",
                    "data" => $e->getMessage()
                ]);
                return; // on stoppe même en cas d'erreur
            }
        }
    }

    // ==============================
    // CAS  : "dashboard/deleteUser"
    // ==============================
    // Exemple d'URL : dashboard/deleteUser (via POST avec l'id dans $_POST)
    // Vérifie si :
    // - la méthode est POST
    // - le 2ème segment existe
    // - et vaut "deleteUser"
    if ($methode == "POST" && isset($segment[1]) && $segment[1] == "deleteUser") {

        // Récupère l'ID envoyé via le formulaire (méthode POST)
        // - Si $_POST['id'] existe → on le convertit en entier avec (int)
        // - Sinon, si 'id' n'est pas présent dans le POST → on assigne "null"
        $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

        // Vérifie que l'ID est bien défini et supérieur à 0
        // - Cela permet d'éviter les suppressions avec un ID vide ou invalide
        if ($id) {
            $UserController = new UserController(); // on instancie le controller des users
            $UserController->deleteUser($id);       // on appelle la fonction qui supprime le user correspondant
        }

        // Arrête l'exécution après la tentative de suppression
        // - Peu importe si l'offre a été supprimée ou non
        return;
    }

    if ($methode == "GET") {

        $UserController = new CompanyController;
        $UserController->indexAll();
        return;
    }
}

if ($segment[0] == "dashboard_company") {
    $activePage = "dashboard_company";

    // Vérifie que l'utilisateur est bien une société
    if ($role !== 'company') {
        http_response_code(403);
        echo "Accès refusé. Vous devez être une société !";
        return;
    }

    // Récupère l'ID de la société depuis la session
    $userId  = (int) ($_SESSION['new_id'] ?? 0);

    // var_dump($userId);
    // die;

    if (!$userId) {
        echo "ID Utilisateur introuvable.";
        return;
    }

    // Appelle du contrôleur et sa fonction
    $CompanyController = new CompanyController();
    $CompanyController->showOfferById($userId);
    return;
}

// var_dump($segment, $methode);
// die;

if ($segment[0] == "myRequest") {
    $activePage = "myRequest";

    $RequestController = new RequestController();

    $id = $_SESSION['new_id'] ?? null;

    // var_dump($id); // id de la personne connecté
    // die;

    if (isset($segment[1]) && $segment[1] == "addMyRequest") {

        if ($methode === "POST") {
            $RequestController->addMyRequest(); // traite le formulaire
            return;
        }

        if ($methode === "GET") {
            $RequestController->addRequestForm('myRequest');  // affiche le formulaire spécifique
            return;
        }
    }

    // Cas : Requête POST pour supprimer by id / donc url = request/deleteMyRequest
    if ($methode == "POST" && isset($segment[1]) && $segment[1] == "deleteRequest") {

        // var_dump($segment, $methode, $_POST);
        // die; // le code s’arrête ici UNIQUEMENT pour ce POST afin de verifier ce qu'il reçoit

        $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

        if ($id) {
            $RequestController->deleteMyRequest($id);
            return;
        }
    }

    // var_dump($segment, $methode, $_POST);
    // die;

    if ($methode == "GET" && $id !== null) {
        $RequestController->requestById($id); // Affiche les demandes de l'utilisateur connecté
        return;
    }
}

if ($segment[0] == "request") {
    $activePage = "request";

    $RequestController = new RequestController();

    if (isset($segment[1]) && $segment[1] == "addRequest") {

        if ($methode === "GET") {
            $RequestController->addRequestForm();  // affiche le formulaire
            return;
        }

        if ($methode === "POST") {
            $RequestController->addRequest(); // traite le formulaire
            return;
        }
    }

    // Cas : Requête POST pour supprimer by id / donc url = request/deleteRequest
    if ($methode == "POST" && isset($segment[1]) && $segment[1] == "deleteRequest") {

        $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

        if ($id) {
            $RequestController->deleteRequest($id);
        }
        return;
    }

    // Cas : Requête POST pour finaliser une demande (changement de statut)
    if ($methode == "POST" && isset($segment[1]) && $segment[1] == "toggleStatus") {

        $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

        if ($id) {
            $RequestController->toggleStatus();
        }
        return;
    }

    if ($methode == "GET") {

        $RequestController->index();
        return;
    }
}

if ($segment[0] == "contact") {
    $activePage = "contact";
    if ($methode == "GET") {

        render('contact', [
            "title" => "Contact"
        ]);
        return;
    }
}

// Vérifie si le premier segment de l'URL est "favoris"
// Exemple : /favoris ou /favoris/add/5
if ($segment[0] == "favoris") {

    // Définit la page active pour le menu ou la vue
    $activePage = "favoris";

    // Instancie le contrôleur des favoris pour gérer les actions
    $favorisController = new FavorisController();

    // ----- Route : /favoris -----
    // Vérifie si la méthode HTTP est GET et qu'il n'y a pas de second segment
    // Cela correspond à la page qui listera tous les favoris
    if ($methode == "GET" && !isset($segment[1])) {
        $favorisController->index(); // Appelle la méthode index() pour afficher les favoris
        return; // Stoppe l'exécution ici pour ne pas vérifier les autres routes
    }

    // ----- Route : /favoris/add/{id} -----
    // Vérifie si le second segment est "add", un troisième segment existe (l'ID) et la méthode est GET
    // Cela correspond à l'action d'ajouter un favori
    if (isset($segment[1]) && $segment[1] == "add" && isset($segment[2]) && $methode == "GET") {
        $favorisController->add($segment[2]); // Appelle add() avec l'ID passé dans l'URL
        return; // Stoppe l'exécution pour éviter les conflits avec d'autres routes
    }

    // ----- Route : /favoris/remove/{id} -----
    // Vérifie si le second segment est "remove", un troisième segment existe (l'ID) et la méthode est GET
    // Cela correspond à l'action de retirer un favori
    if (isset($segment[1]) && $segment[1] == "remove" && isset($segment[2]) && $methode == "GET") {
        $favorisController->remove($segment[2]); // Appelle remove() avec l'ID passé dans l'URL
        return; // Stoppe l'exécution pour éviter les conflits avec d'autres routes
    }
}

if ($segment[0] == "profil") {
    $activePage = "profil";

    // Si on est dans le cas : profil/updateProfil
    // Cas : Requête GET pour recup le formulaire de modification
    if ($methode == "GET" && isset($segment[1]) && $segment[1] == "updateProfil") {

        $profilController = new UserController;
        $profilController->updateProfilForm(); // Plus besoin de passer d'ID
        return;
    }

    // Si on est dans le cas : profil/updateProfil/6
    // Cas : Requête PUT/PATCH pour modifier le profil
    if ($methode == "POST" && isset($segment[1]) && $segment[1] == "updateProfil") {

        // var_dump($_POST);
        // die;

        try {
            $profilController = new UserController;
            $profilController->updateProfil($_POST);
            return;
        } catch (PDOException $e) {
            echo json_encode(["message" => "Échec de modification du profil", "data" => $e->getMessage()]);
            return;
        }
    }

    // Affichage du profil (GET /profil)
    if ($methode == "GET") {

        $profilController = new UserController;
        $profilController->index();
        return;
    }
}
