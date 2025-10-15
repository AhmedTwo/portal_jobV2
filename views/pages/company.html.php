<link rel="stylesheet" href="/assets/css/companys.css">

<?php
$role = $_SESSION['new_role'] ?? null;
?>

<main>
    <h1>TOUTES LES SOCIÉTÉS !</h1>
    <p class="p">Découvre toutes nos société inscrit à Portal_Job</p>

    <div class="company-grid" id="companyContainer">
        <?php foreach ($company as $index => $c): ?>
            <div class="company-card <?= $index >= 4 ? 'extra-company' : '' ?>" <?= $index >= 4 ? 'style="display: none;"' : '' ?>>
                <a href="offers/offerCompany/<?= $c['id'] ?>">
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

    <?php if (count($company) > 4): ?>
        <button id="showMoreBtn" class="btn-details" style="margin-top: 2rem;">Voir plus</button>
    <?php endif; ?>
</main>

<script>
    const showMoreBtn = document.getElementById('showMoreBtn');
    const companyCards = document.querySelectorAll('.company-card');
    let shown = 4;

    showMoreBtn?.addEventListener('click', () => {
        let revealed = 0;
        companyCards.forEach((card, index) => {
            if (index >= shown && revealed < 4) {
                card.style.display = 'flex';
                revealed++;
            }
        });
        shown += revealed;
        if (shown >= companyCards.length) {
            showMoreBtn.style.display = 'none';
        }
    });
</script>