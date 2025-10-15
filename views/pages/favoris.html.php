<link rel="stylesheet" href="/assets/css/favoris.css">

<h1>MES OFFRES FAVORIS</h1>

<?php if (empty($offers)): ?>
    <p class="if_no_favoris">Vous n'avez aucun favori pour le moment.</p>
<?php else: ?>
    <div class="offers-grid">
        <?php foreach ($offers as $offer): ?>
            <div class="offer-card">
                <img src="<?= htmlspecialchars($offer["image_url"]) ?>" alt="Logo entreprise">
                <div class="content">
                    <h3 class="title_h3"><?= htmlspecialchars($offer["title"]) ?></h3>
                    <p><?= htmlspecialchars($offer["contrat"]) ?></p>
                    <p><?= htmlspecialchars($offer["location"]) ?></p>
                </div>
                <a href="offers/offerDetails/<?= $offer["id"] ?>" class="btn-details">Détails</a>
                <a href="favoris/remove/<?= $offer["id"] ?>" class="btn-heart active">❤️</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>