<?php

require_once dirname(__DIR__) . '/config/render.php';
require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/models/Users.php';

class UserController
{

    public function index($pdo)
    {
        $profilData = null;

        if (isset($_SESSION['new_id'])) {
            $newProfil = new Users();
            $profilData = $newProfil->readProfil($pdo, $_SESSION['new_id']);
        } else {
            echo "Vous devez être connecté pour voir votre profil.";
        }

        render('profil', [
            "profilData" => $profilData,
            "title" => "Profil"
        ]);
    }

    public function update($pdo)
    {

        $updateById = new Users();
        $row = $updateById->UpdateUser($pdo);

        $chooseContrat = new Users();
        $contrat = $chooseContrat->chooseContrat($pdo);

        render('updateUser', [
            "contrat" => $contrat,
            "row" => $row,
            "title" => "Utilisateur Modif"
        ]);
    }

    public function addUsers($pdo)
    {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
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

                $role = (substr($_POST["inputEmail"], -strlen($_POST["inputEmail"])) === '@company.com') ? 'company' : 'client';
                // // substr extrait une sous-chaîne à partir de la fin de l'email indiqué dans le form
                // // -strlen calcule la longueur de la chaîne // - devant strlen(...) signifie : "pars depuis la fin".

                // Création des dossiers s'ils n'existent pas
                if (!is_dir('uploads/cv')) {
                    mkdir('uploads/cv', 0777, true);
                }
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

                $user = new Users();

                $user->setNom($_POST['inputNom']);
                $user->setPrenom($_POST['inputPrenom']);
                $user->setEmail($_POST['inputEmail']);
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


                if ($user->addUsers($pdo)) {
                    // Redirection vers la page connexion
                    header("Location: /connexion.php");
                    exit;
                } else {
                    echo "Erreur lors de l'ajout de l'utilisateur.";
                }
            } else {
                echo "Veuillez remplir tous les champs requis.";
            }
        }

        render('addUser', [
            "title" => "Ajout d'utilisateur"
        ]);
    }
}
