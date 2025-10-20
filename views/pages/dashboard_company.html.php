<link rel="stylesheet" href="/assets/css/offers.css">

<?php
require_once dirname(__DIR__, 2) . '/includes/svg.php';

$role = $_SESSION['new_role'] ?? null;
?>

<main>
    <h1>LES OFFRES DE MA SOCIÉTÉ</h1>
    <p class="p">Un récapitulatif de toutes mes offres</p>

        <?php if (!empty($offers_company)): ?>
            <?php foreach ($offers_company as $offer): ?>
                <div class="offer-row">

            <!-- Carte gauche -->
            <div class="offer-card">
                <?php if (!empty($offer["image_url"])): ?>
                    <a href="offers/offerCompany/<?= $offer["id_company"] ?>" style="text-decoration: none; text-align: center;">
                        <h3>IMAGE DE L'OFFRE</h3>
                        <img src="<?= htmlspecialchars($offer["image_url"]) ?>" alt="Image Offre">
                    </a>
                <?php endif; ?>

                <?php if ($role === 'client' || $role === 'admin'): ?>
                    <a href="/accueil/apply?id=<?= $offer["id"] ?>" class="apply-btn">
                        Postuler à l'offre
                    </a>
                <?php endif; ?>
            </div>

            <div class="offer-details">
                <h3>Détails de l'offre</h3>

                <div class="detail-item"><strong><?= $lieu ?> Lieu :</strong> <?= htmlspecialchars($offer["location"]) ?></div>
                <div class="detail-item"><strong><?= $poste ?> Poste :</strong> <?= htmlspecialchars($offer["category"]) ?></div>
                <div class="detail-item"><strong><?= $postulant ?> Postulants :</strong> <?= htmlspecialchars($offer["participants_count"]) ?></div>
                <div class="detail-item"><strong><?= $date ?> Publié le :</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($offer["created_at"]))) ?></div>
            </div>
            
            <div>
                <a href="offers/updateOffer/<?= $offer["id"] ?>" class="btn-details" style="background-color: #ffc107;">✏️</a><br>
                <form method="POST" action="offers/deleteOffer" onsubmit="return confirm('Es-tu sûr de vouloir supprimer cette offre ?')" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $offer['id'] ?>">
                    <button type="submit" class="btn-details" style="background-color: #f31228ff; cursor: pointer;">🗑️</button>
                </form>
            </div>

        </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="color:red;">⚠️ Aucune offre trouvée</p>
        <?php endif; ?>
</main>