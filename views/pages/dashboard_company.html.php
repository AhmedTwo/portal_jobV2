<link rel="stylesheet" href="/assets/css/offers.css">

<div class="recent-offers-container">
    <h1>LES OFFRES DE MA SOCIÉTÉ</h1>

    <br><br>

    <div class="offers-grid" id="offersContainer">
        <?php if (!empty($offers_company)): ?>
            <?php foreach ($offers_company as $offer): ?>
                <div class="offer-card">
                    <?php if (!empty($offer["company_logo"])): ?>
                        <a href="offers/offerCompany/<?= $offer["id_company"] ?>">
                            <img src="<?= htmlspecialchars($offer["company_logo"]) ?>" alt="Logo entreprise">
                        </a>
                    <?php endif; ?>

                    <p style="color:black; font-weight:bold;"><?= htmlspecialchars($offer["nom_company"]) ?></p>
                    <h3><?= htmlspecialchars($offer["title"]) ?></h3>

                    <div>
                        <a href="offers/offerDetails/<?= $offer["id"] ?>" class="btn-details">Détails</a>

                        <a href="offers/updateOffer/<?= $offer["id"] ?>" class="btn-details" style="background-color: #ffc107;">✏️</a>
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
    </div>

</div>