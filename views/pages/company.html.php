<link rel="stylesheet" href="/assets/css/companys.css">

<?php
$role = $_SESSION['new_role'] ?? null;
?>

<main>
    <h1>TOUTES LES SOCIÉTÉS !</h1>
    <p class="p">Découvre toutes nos société inscrit à Portal_Job</p>

    <div class="company-grid" id="companyContainer">
        <?php foreach ($company as $c): ?>
            <div class="company-card">
                <a href=" offers/offerCompany/<?= $c['id'] ?>">
                    <img src="<?= htmlspecialchars($c['logo']) ?>" alt="Logo entreprise">
                </a>

                <h3><?= htmlspecialchars($c['name']) ?></h3>
                <p><?= htmlspecialchars($c['industry']) ?></p>

                <div>
                    <a href="company/companyDetails/<?= $c['id'] ?>" class="btn-details">Détails</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>