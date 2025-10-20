<?php

require_once dirname(__DIR__) . '/config/render.php';
require_once dirname(__DIR__) . '/models/User.php';
require_once dirname(__DIR__) . '/controllers/companyController.php';
require_once dirname(__DIR__) . '/includes/traitement_formulaire_sendPassword.php';

class UserController
{

    public function index()
    {
        $profilData = null;

        if (isset($_SESSION['new_id'])) {
            $newProfil = new User();
            $profilData = $newProfil->readProfil($_SESSION['new_id']);
        }

        render('profil', [
            "profilData" => $profilData,
            "title" => "Profil"
        ]);
    }

    public function passwordForget()
    {
        render('password', [
            "title" => "Mot de passe Oublié"
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

    public function sendEmail()
    {
        $email = trim($_POST['inputEmail']);

        try {
            // Étape 1 : instancier les modèles nécessaires
            $userModel = new User();
            $companyModel = new Company();

            // Étape 2 : vérifier si l’email existe dans la table users
            $user = $userModel->getUserByEmail($email);

            // Étape 3 : générer un nouveau mot de passe (avec une classe ou fonction utilitaire)
            $newPassword = $this->genererMotDePasse(8); // on genere un mdp
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // on le hash

            if ($user) {
                // Met à jour le mot de passe de l’utilisateur hashé
                $userModel->updatePassword(['inputPassword' => $hashedPassword], $user['id']);

                // Vérifie si le user appartient à une société
                if (!empty($user['company_id'])) {
                    $company = $companyModel->findById($user['company_id']);

                    if ($company && !empty($company['email_company'])) {
                        sendPassword($company['email_company'], $newPassword);
                        $_SESSION['success'] = "<Un email a été envoyé à la société liée ({$company['email_company']}).";
                        return; //  stop ici afin de passer au prochain success si besoin
                    } else {
                        $_SESSION['error'] = "Aucune adresse email trouvée pour la société liée.";
                    }
                } else {
                    // Si pas de société → on envoie à l'utilisateur
                    sendPassword($user['email'], $newPassword);
                    $_SESSION['success'] = "Un email a été envoyé à l'utilisateur ({$user['email']}).";
                    return;
                }
            }

            // Étape 4 : sinon, on cherche dans la table company
            $company = $companyModel->getCompanyByEmail($email);

            if ($company) {
                $userLinked = $userModel->getUserByCompanyId($company['id']);

                if ($userLinked) {
                    $userModel->updatePassword(['inputPassword' => $hashedPassword], $userLinked['id']);
                    sendPassword($company['email_company'], $newPassword);

                    $_SESSION['success'] = "Un email a été envoyé à la société ({$company['email_company']}).";
                    return;
                } else {
                    $_SESSION['error'] = "Aucun utilisateur lié à cette société.";
                }
            } else {
                $_SESSION['error'] = "Email introuvable dans la base de données.";
            }
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>
                Erreur BDD : " . htmlspecialchars($e->getMessage()) . "
            </div>";
        }
    }

    public function login()
    {
        $email = $_POST["inputEmail"] ?? '';
        $inputPassword = $_POST["inputMdp"] ?? '';

        // var_dump($_POST);
        // die;

        $userController = new User();
        $user = $userController->findOne($email);

        if ($user && password_verify($inputPassword, $user['password'])) {
            $_SESSION['new_id'] = $user['id'];        // ID de l'utilisateur
            $_SESSION['new_email'] = $user['email'];
            $_SESSION['new_nom'] = $user['nom'];
            $_SESSION['new_prenom'] = $user['prenom'];
            $_SESSION['new_role'] = $user['role'];

            if ($user['role'] === 'company') {
                $_SESSION['company_id'] = $user['id'];
            }

            $_SESSION['success'] = "Félicitations, vous êtes bien connecté !";

            header('Location: /accueil');
            exit;
        } elseif (!empty($email) && !empty($inputPassword)) {
            $_SESSION['error'] = "L'identifiant et/ou mot de passe est incorrect !";
        } else {
            $_SESSION['error'] = "Les champs sont vides, veuillez les remplir !";
        }

        header('Location: /connexion');
        exit;
    }

    public function updateProfilForm()
    {

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['new_id'])) {
            $_SESSION['error'] = "Vous devez être connecté pour accéder à cette page.";
            header('Location: /connexion');
            exit;
        }

        $updateById = new User();
        $row = $updateById->getUserById($_SESSION['new_id']); // Utilise l'ID de session

        render('updateUser', [
            "row" => $row,
            "title" => "Modifier mon profil"
        ]);
    }

    public function updateProfilFormById($id)
    {
        $updateById = new User();
        $row = $updateById->getUserById($id); // Utilise l'ID de session

        render('updateUser', [
            "row" => $row,
            "title" => "Modifier mon profil"
        ]);
    }

    public function updateProfil($POST)
    {

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['new_id'])) {
            $_SESSION['error'] = "Vous devez être connecté pour effectuer cette action.";
            header('Location: /connexion');
            exit;
        }

        if (
            !empty($POST['inputNom']) &&
            !empty($POST['inputPrenom']) &&
            !empty($POST['inputTel']) &&
            !empty($POST['inputCity']) &&
            !empty($POST['inputZipcode']) &&
            isset($POST['inputDispo']) // isset car pour moi le 0 n'est pas considéré comme vide mais comme "NON"
        ) {
            try {
                $user = new User();

                $user->setNom($POST['inputNom']);
                $user->setPrenom($POST['inputPrenom']);
                $user->setTelephone($POST['inputTel']);
                $user->setVille($POST['inputCity']);
                $user->setCodePostal($POST['inputZipcode']);
                $user->setDisponibilite($POST['inputDispo']);

                // Ajouter l'ID de session aux données POST
                $POST['id'] = $_SESSION['new_id'];

                $user->updateUserInDB($POST);

                // Mettre à jour les données de session si nécessaire
                $_SESSION['new_nom'] = $POST['inputNom'];
                $_SESSION['new_prenom'] = $POST['inputPrenom'];

                $_SESSION['success'] = "Profil mis à jour avec succès !";
                header("Location: /profil?success=1");
                exit;
            } catch (PDOException $e) {
                $_SESSION['error'] = "Erreur lors de la mise à jour : " . $e->getMessage();
                header("Location: /profil/updateProfil");
                exit;
            }
        } else {
            $_SESSION['error'] = "Veuillez remplir tous les champs requis.";
            header("Location: /profil/updateProfil");
            exit;
        }
    }

    public function updateProfilById($id)
    {

        if (
            !empty($_POST['inputNom']) &&
            !empty($_POST['inputPrenom']) &&
            !empty($_POST['inputTel']) &&
            !empty($_POST['inputCity']) &&
            !empty($_POST['inputZipcode'])
        ) {
            try {

                // ✅ Sécurité : Vérifie que l’ID du formulaire correspond bien à celui de l’URL
                if (isset($_POST['id']) && (int)$_POST['id'] !== (int)$id) {
                    $_SESSION['error'] = "ID utilisateur invalide.";
                    header("Location: /dashboard");
                    exit;
                }

                $user = new User();

                $data = [
                    'id' => (int) $id,
                    'inputNom' => $_POST['inputNom'],
                    'inputPrenom' => $_POST['inputPrenom'],
                    'inputTel' => $_POST['inputTel'],
                    'inputCity' => $_POST['inputCity'],
                    'inputZipcode' => $_POST['inputZipcode'],
                ];

                $user->updateUserInDbById($data, $id);

                $_SESSION['success'] = "Profil mis à jour avec succès !";


                // Redirection selon l’utilisateur modifié
                $sessionUserId = $_SESSION['new_id'] ?? null;

                if ($id == $sessionUserId) { // <- on compare juste la valeur
                    header("Location: /profil?success=1");
                    exit;
                } else {
                    header("Location: /dashboard?success=1");
                    exit;
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = "Erreur lors de la mise à jour : " . $e->getMessage();
                header("Location: /dashboard/updateUser/" . $id);
                exit;
            }
        } else {
            $_SESSION['error'] = "Veuillez remplir tous les champs requis.";
            header("Location: /dashboard/updateUser/" . $id);
            exit;
        }
    }

    public function addUsers()
    {

        if (
            !empty($_POST["inputNom"]) &&
            !empty($_POST["inputPrenom"]) &&
            !empty($_POST["inputEmail"]) &&
            !empty($_POST["inputPassword"]) &&
            !empty($_POST["inputTelephone"]) &&
            !empty($_POST["inputVille"]) &&
            !empty($_POST["inputZipcode"]) &&
            !empty($_POST["inputQualification"]) &&
            !empty($_POST["inputPreference"]) &&
            isset($_POST["choix"]) &&
            isset($_FILES["inputCv"]) && $_FILES["inputCv"]["error"] === UPLOAD_ERR_OK &&
            isset($_FILES["inputPhoto"]) && $_FILES["inputPhoto"]["error"] === UPLOAD_ERR_OK
        ) {

            $role = (substr($_POST["inputEmail"], -strlen('@company.com')) === '@company.com') ? 'company' : 'client';
            // // substr extrait une sous-chaîne à partir de la fin de l'email indiqué dans le form
            // // -strlen calcule la longueur de la chaîne // - devant strlen(...) signifie : "pars depuis la fin".

            // Création des dossiers s'ils n'existent pas
            if (!is_dir('uploads/photos')) {
                mkdir('uploads/photos', 0777, true);
            }

            // Noms de fichiers uniques
            $cv = uniqid('cv_') . '_' . basename($_FILES["inputCv"]["name"]);
            $photo = uniqid('photo_') . '_' . basename($_FILES["inputPhoto"]["name"]);

            // Déplacement
            // Chemin temporaire du fichier stocké automatiquement par PHP.
            move_uploaded_file($_FILES["inputCv"]["tmp_name"], "uploads/cv/" . $cv);
            move_uploaded_file($_FILES["inputPhoto"]["tmp_name"], "uploads/photos/" . $photo);

            $user = new User();

            $user->setNom($_POST['inputNom']);
            $user->setPrenom($_POST['inputPrenom']);
            $user->setEmail($_POST['inputEmail']);

            // récupérer le mot de passe en clair depuis le form
            // $plainPassword = $_POST['inputPassword'];

            $user->setPassword(password_hash($_POST['inputPassword'], PASSWORD_DEFAULT));
            // ca va générer un hash sécurisé avec sel intégré automatiquement, en utilisant l'algorithme recommandé par PHP (actuellement Bcrypt).
            $user->setRole($role);
            $user->setTelephone($_POST['inputTelephone']);
            $user->setVille($_POST['inputVille']);
            $user->setCodePostal($_POST['inputZipcode']);
            $user->setQualification($_POST['inputQualification']);
            $user->setPreference($_POST['inputPreference']);
            $user->setDisponibilite($_POST['choix']);
            $user->setCvPdf($cv);
            $user->setPhoto($photo);

            if ($user->addUsers()) {
                // Redirection vers la page connexion
                header("Location: /connexion");
                exit;
            } else {
                echo "Erreur lors de l'ajout de l'utilisateur.";
            }
        } else {
            echo "Veuillez remplir tous les champs requis.";
        }

        render('addUser', [
            "title" => "Inscription"
        ]);
    }

    public function addUserForm()
    {
        // Affichage du formulaire (GET)
        render('addUser', [
            "title" => "Inscription"
        ]);
    }

    public function deleteUser($id)
    {
        $userModel = new User();
        $requestModel = new Request(); // si tu as un modèle pour les demandes

        // Vérifier si l'utilisateur a des demandes associées
        $request = $requestModel->getById($id);

        if (!empty($request)) {
            // Rediriger avec un message d'erreur (par exemple via session)
            $_SESSION['error'] = "Impossible de supprimer cet utilisateur : il a encore des demandes en cours.";
            header("Location: /dashboard");
            exit;
        }

        // Sinon, suppression possible
        $userModel->deleteById($id);
        $_SESSION['success'] = "Utilisateur supprimé avec succès.";
        header("Location: /dashboard");
        exit;
    }
}
