<div>
        <br>
        <h1>📢 Les 3 offres les plus récentes</h1>
        <p>Découvrez les dernières opportunités publiées</p>
        <br><br><br>
    </div>

    <div>
        <?php foreach ($offers3 as $offer): ?>
            <div>
                <div>
                    <div>
                        <h3><?= $offer["title"] ?></h3>
                        <p>
                            <span><?= $offer["contrat"] ?></span>
                        </p>
                        <?php if (!empty($offer["image_url"])): ?>
                            <img src="<?= $offer["image_url"] ?>" width="300px" alt="Image offre">
                        <?php endif; ?>
                        <div>
                            <a href="OfferDetails.php?id=<?= $offer["id"] ?>">
                                Voir les détails
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>