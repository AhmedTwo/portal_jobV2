<?php

class Favorite
{
    private $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=localhost;dbname=job_portal;charset=utf8";
        $username = "root";
        $password = "root";

        try {
            // on tente la connexion
            $this->pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            // si jamais sa casse, on intercepete l'erreur
            echo "Connexion échouée !" . $e->getMessage();
        }
    }

    public function addFavorite($userId, $offerId)
    {
        $sql = "INSERT IGNORE INTO favorites (user_id, offer_id) VALUES (:user_id, :offer_id)";
        // IGNORE = ignore l’insertion au lieu de planter ❌
        $pdostmt = $this->pdo->prepare($sql);
        $pdostmt->execute([
            ':user_id' => $userId,
            ':offer_id' => $offerId
        ]);
    }

    public function removeFavorite($userId, $offerId)
    {
        $sql = "DELETE FROM favorites WHERE user_id = :user_id AND offer_id = :offer_id";
        $pdostmt = $this->pdo->prepare($sql);
        $pdostmt->execute([
            ':user_id' => $userId,
            ':offer_id' => $offerId
        ]);
    }

    // retourne les offres favorites pour un utilisateur
    public function getFavoritesByUser($userId)
    {
        $sql = "SELECT job_offers.*, e.name AS contrat, c.name AS nom_company, c.logo AS company_logo
        FROM favorites
        JOIN job_offers ON favorites.offer_id = job_offers.id
        JOIN employment_type e ON job_offers.employment_type_id = e.id
        JOIN company c ON job_offers.id_company = c.id
        WHERE favorites.user_id = :user_id
        ";
        $pdostmt = $this->pdo->prepare($sql);
        $pdostmt->execute(['user_id' => $userId]);
        return $pdostmt->fetchAll();
    }

    // pratique pour l’affichage (coeur rempli ou vide)
    public function isFavorite($userId, $offerId)
    {
        $sql = "SELECT COUNT(*) FROM favorites WHERE user_id = :user_id AND offer_id = :offer_id";
        $pdostmt = $this->pdo->prepare($sql);
        $pdostmt->execute([
            ':user_id' => $userId,
            ':offer_id' => $offerId
        ]);
        return $pdostmt->fetchColumn() > 0;
    }
}
