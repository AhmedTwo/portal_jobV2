<?php
// On inclut le modèle Offer qui permet d'interagir avec les offres (ex: récupérer une offre en BDD)
require_once 'models/Favorite.php';

class FavorisController
{

    // Méthode qui affiche la page des favoris
    public function index()
    {
        $userId = $_SESSION['new_id'] ?? null;

        if (!$userId) {
            header("Location: /connexion");
            exit;
        }

        $favoriteModel = new Favorite();
        $offers = $favoriteModel->getFavoritesByUser($userId);

        render('favoris', [
            "offers" => $offers,
            "title" => "Mes Favoris",
        ]);
    }
    // Méthode pour ajouter une offre aux favoris
    public function add($id)
    {
        $userId = $_SESSION['new_id'] ?? null;

        if ($userId) { // 👉 seulement si connecté
            $favoriteModel = new Favorite();
            $favoriteModel->addFavorite($userId, (int) $id);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    // Méthode pour retirer une offre des favoris
    public function remove($id)
    {

        $userId = $_SESSION['new_id'] ?? null;

        if ($userId) {
            $favoriteModel = new Favorite();
            $favoriteModel->removeFavorite($userId, (int) $id);

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
}
