<link rel="stylesheet" href="/assets/css/accueil.css">

<?php
require_once dirname(__DIR__, 2) . '/includes/svg.php';

$role = $_SESSION['new_role'] ?? null;

$userId = $_SESSION['new_id'] ?? null;
$favoriteModel = new Favorite();
?>

<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<main>
    <h1>LES 3 OFFRES LES PLUS RECENTES</h1>
    <p class="p">Découvrez les dernières opportunités publiées</p>

    <?php foreach ($offers3 as $offer): ?>
        <div class="offer-row">
            <!-- Carte de l'offre (à gauche) -->
            <div class="offer-card">
                <?php if (!empty($offer["image_url"])): ?>
                    <h3>IMAGE OFFRE</h3>
                    <img src="<?= htmlspecialchars($offer["image_url"]) ?>" alt="Image offre">
                <?php endif; ?>

                <?php if ($role === 'client' || $role === 'admin'): ?>
                    <div class="apply-section">
                        <a href="/accueil/apply?id=<?= $offer["id"] ?>" class="apply-btn" title="Voir les détails">
                            Postuler à l'offre
                        </a>
                    </div>
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


            <!-- Détails de l'offre (à droite de l'écran) -->
            <div class="offer-details">
                <h3>Détails de l'offre</h3>

                <div class="detail-item"><strong><?= $description ?> Description :</strong> <?= htmlspecialchars($offer["description"]) ?></div>

                <div class="detail-item"><strong><?= $mission ?> Mission :</strong> <?= htmlspecialchars($offer["mission"]) ?></div>

                <div class="detail-item"><strong><?= $societe ?> Société :</strong> <?= htmlspecialchars($offer["nom_company"]) ?></div>

                <div class="detail-item"><strong><?= $lieu ?> Lieu :</strong> <?= htmlspecialchars($offer["location"]) ?></div>

                <div class="detail-item"><strong><?= $poste ?> Poste :</strong> <?= htmlspecialchars($offer["category"]) ?></div>

                <div class="detail-item"><strong><?= $postulant ?> Postulants :</strong> <?= htmlspecialchars($offer["participants_count"]) ?></div>

                <div class="detail-item"><strong><?= $avantage ?> Avantages :</strong> <?= htmlspecialchars($offer["benefits"]) ?></div>

                <div class="detail-item"><strong><?= $date ?> Publié le :</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($offer["created_at"]))) ?></div></div>
        </div>
    <?php endforeach; ?>
</main>