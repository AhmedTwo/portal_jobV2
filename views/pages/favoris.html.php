<link rel="stylesheet" href="/assets/css/offers.css">

<?php
require_once dirname(__DIR__, 2) . '/includes/svg.php';

$role = $_SESSION['new_role'] ?? null;

$userId = $_SESSION['new_id'] ?? null;
$favoriteModel = new Favorite();
?>


<h1>MES OFFRES FAVORIS</h1>
<main>

    <?php if (empty($offers)): ?>
        <p class="if_no_favoris">Vous n'avez aucun favori pour le moment.</p>
        <p class="if_no_favoris">Ajoute-en depuis la page : <strong><a href="/offers">offers</a></strong> en cliquant ici !</p>
    <?php else: ?>

        <?php foreach ($offers as $offer): ?>
            <div class="offer-row">

                <!-- Carte gauche -->
                <div class="offer-card">
                    <?php if (!empty($offer["company_logo"])): ?>
                        <a href="offers/offerCompany/<?= $offer["id_company"] ?>">
                            <img src="<?= htmlspecialchars($offer["company_logo"]) ?>" alt="Logo entreprise">
                        </a>
                    <?php endif; ?>

                    <?php if ($role === 'client' || $role === 'admin'): ?>
                        <a href="/accueil/apply?id=<?= $offer["id"] ?>" class="apply-btn">
                            Postuler à l'offre
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Bouton favoris -->
                <?php if ($role === 'client'): ?>
                    <div>
                        <?php if ($userId && $favoriteModel->isFavorite($userId, $offer["id"])): ?>
                            <a href="favoris/remove/<?= $offer["id"] ?>" class="btn-heart active">
                                <span style="font-size: 20px;">❤️</span>
                            </a>
                        <?php else: ?>
                            <a href="favoris/add/<?= $offer["id"] ?>" class="btn-heart">
                                <span style="font-size: 35px;">♡</span>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Détails droite -->
                <div class="offer-details">
                    <h3>Détails de l'offre</h3>

                    <div class="detail-item"><strong><?= $description ?> Description :</strong> <?= htmlspecialchars($offer["description"]) ?></div>
                    <div class="detail-item"><strong><?= $mission ?> Mission :</strong> <?= htmlspecialchars($offer["mission"]) ?></div>
                    <div class="detail-item"><strong><?= $societe ?> Société :</strong> <?= htmlspecialchars($offer["nom_company"]) ?></div>
                    <div class="detail-item"><strong><?= $lieu ?> Lieu :</strong> <?= htmlspecialchars($offer["location"]) ?></div>
                    <div class="detail-item"><strong><?= $poste ?> Poste :</strong> <?= htmlspecialchars($offer["category"]) ?></div>
                    <div class="detail-item"><strong><?= $postulant ?> Postulants :</strong> <?= htmlspecialchars($offer["participants_count"]) ?></div>
                    <div class="detail-item"><strong><?= $avantage ?> Avantages :</strong> <?= htmlspecialchars($offer["benefits"]) ?></div>
                    <div class="detail-item"><strong><?= $date ?> Publié le :</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($offer["created_at"]))) ?></div>
                </div>

            </div>
        <?php endforeach; ?>
    <?php endif; ?>