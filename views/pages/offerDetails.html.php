<div class="container my-5">
    <br>
    <br>
    <div class="text-center mb-5">
        <h1 class="display- fw-bold text-primary"><i class="fa-solid fa-briefcase"></i> <?= $offers['title'] ?></h1>
        <p class="lead text-muted">Découvrez tous les détails de cette opportunité</p>
    </div>

    <div class="card shadow-lg border-0 rounded-4 p-5">
        <div class="row g-5">
            <div class="col-md-5 text-center">
                <?php if (!empty($offers["image_url"])): ?>
                    <img src="<?= $offers["image_url"] ?>" alt="Image offre" class="img-fluid rounded-4 shadow" style="max-height: 300px;">
                <?php else: ?>
                    <div class="text-muted">Aucune image disponible</div>
                <?php endif; ?>
                <?php if (isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'client' || $_SESSION['new_role'] === 'admin'): ?>
                    <div class="mb-3">
                        <br><br>
                        <a href="apply.php?id=<?= $offers["id"] ?>" type="submit" class="btn btn-primary" title="Voir les détails">
                            Postuler à l'offre
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-md-7">
                <h3 class="fw-bold mb-3">DESCRIPTION</h3>
                <p class="fs-5"><?= $offers["description"] ?></p>

                <h4 class="fw-semibold mt-4">MISSION DEMANDEES</h4>
                <p class="fs-5"><?= $offers["mission"] ?></p>

                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <strong>LIEU :</strong> <span class="fs-5"><?= $offers["location"] ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>POSTE :</strong> <span class="fs-5"><?= $offers["category"] ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>SOCIETE :</strong> <span class="fs-5"><?= $offers["nom_company"] ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>TYPE DE CONTRAT :</strong> <span class="fs-5"><?= $offers["contrat"] ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>TECHNOLOGIES UTILISEES :</strong> <span class="fs-5"><?= $offers["technologies_used"] ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>AVANTAGES DU POSTE :</strong> <span class="fs-5"><?= $offers["benefits"] ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>POSTULANTS :</strong> <span class="fs-5"><?= $offers["participants_count"] ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>DATE DE CREATION :</strong> <span class="fs-5"><?= date("d/m/Y", strtotime($offers["created_at"])) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
