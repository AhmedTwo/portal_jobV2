<link rel="stylesheet" href="/assets/css/offers.css">

<?php

require_once dirname(__DIR__, 2) . '/includes/svg.php';

$role = $_SESSION['new_role'] ?? null;
$userId = $_SESSION['new_id'] ?? null;

$favoriteModel = new Favorite();
?>

<main>
    <h1>TOUTES LES OFFRES !</h1>
    <p class="p">Découvre toutes nos opportunités publiées</p>

    <?php if ($role === 'company'): ?>
        <div class="admin-add-offer">
            <a href="offers/addOffers" class="btn btn-outline-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-plus-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg>
                AJOUTER UNE OFFRE
            </a>
        </div>
    <?php endif; ?>

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

    <?php if (count($offers) > 4): ?>
        <button id="showMoreBtn" class="btn-details" style="margin-top: 2rem;">Voir plus</button>
    <?php endif; ?>
</main>

<script>
    // Sélection des éléments
    const showMoreBtn = document.getElementById('showMoreBtn');
    const offerRows = document.querySelectorAll('.offer-row');

    // Afficher uniquement les 4 premières offres
    let shown = 4;
    offerRows.forEach((row, index) => {
        if (index >= shown) {
            row.style.display = 'none';
        }
    });

    // Révéler 4 offres supplémentaires à chaque clic
    showMoreBtn?.addEventListener('click', () => {
        let revealed = 0;

        offerRows.forEach((row, index) => {
            if (index >= shown && revealed < 4) {
                row.style.display = 'flex';
                revealed++;
            }
        });

        shown += revealed;

        // Masquer le bouton si tout est affiché
        if (shown >= offerRows.length) {
            showMoreBtn.style.display = 'none';
        }
    });
</script>