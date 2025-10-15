<link rel="stylesheet" href="/assets/css/offersDetails.css">

<?php
$role = $_SESSION['new_role'] ?? null;
?>

<div class="page">
    <div class="entete">
        <h1 class="title"><i class="fa-solid fa-briefcase"></i> <?= $offer['title'] ?></h1>
        <p class="subtitle">Découvrez tous les détails de cette opportunité</p>
    </div>

    <div class="card">
        <div class="content">
            <div class="image-section">
                <?php if (!empty($offer["image_url"])): ?>
                    <img src="<?= $offer["image_url"] ?>" alt="Image offre" class="job-image">
                <?php else: ?>
                    <div class="no-image">Aucune image disponible</div>
                <?php endif; ?>
                <?php if ($role === 'client' || $role === 'admin'): ?>
                    <div class="apply-section">
                        <a href="apply?id=<?= $offer["id"] ?>" class="apply-btn" title="Voir les détails">
                            Postuler à l'offre
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="details-section">
                <h3 class="section-title">DESCRIPTION</h3>
                <p class="description"><?= $offer["description"] ?></p>

                <h4 class="section-subtitle">MISSION DEMANDÉES</h4>
                <p class="mission"><?= $offer["mission"] ?></p>

                <div class="info-grid">
                    <div class="info-item">
                        <strong>LIEU :</strong> <span class="info-value"><?= $offer["location"] ?></span>
                    </div>
                    <div class="info-item">
                        <strong>POSTE :</strong> <span class="info-value"><?= $offer["category"] ?></span>
                    </div>
                    <div class="info-item">
                        <strong>SOCIÉTÉ :</strong> <span class="info-value"><?= $offer["nom_company"] ?></span>
                    </div>
                    <div class="info-item">
                        <strong>TYPE DE CONTRAT :</strong> <span class="info-value"><?= $offer["contrat"] ?></span>
                    </div>
                    <div class="info-item">
                        <strong>TECHNOLOGIES UTILISÉES :</strong> <span class="info-value"><?= $offer["technologies_used"] ?></span>
                    </div>
                    <div class="info-item">
                        <strong>AVANTAGES DU POSTE :</strong> <span class="info-value"><?= $offer["benefits"] ?></span>
                    </div>
                    <div class="info-item">
                        <strong>POSTULANTS :</strong> <span class="info-value"><?= $offer["participants_count"] ?></span>
                    </div>
                    <div class="info-item">
                        <strong>DATE DE CRÉATION :</strong> <span class="info-value"><?= date("d/m/Y", strtotime($offer["created_at"])) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>