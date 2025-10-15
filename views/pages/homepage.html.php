<link rel="stylesheet" href="/assets/css/homepage.css">
<link rel="stylesheet" href="/assets/css/header_footer.css">

<main class="hero">
    <img src='/assets/images/imagePortal.png' alt='fond logo portal job' class='background-logo'>
    <div class="hero-content">
        <h1>Votre avenir professionnel commence ici !</h1>
        <h1></h1>
        <p>Explorez les opportunités dans les secteurs en forte croissance : Tech, IA, Transition écologique, Santé... 
            Profitez des options en télétravail, des postes hybrides, et des CDI à pourvoir immédiatement.</p>
        <div class="stats-container">
            <div class="stat-item">
                <span class="stat-number"><?= $usersCount ?></span>
                <span class="stat-label">Utilisateurs inscrits</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?= $offersCount ?></span>
                <span class="stat-label">Offres disponibles</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?= $companysCount ?></span>
                <span class="stat-label">Sociétés inscrites</span>
            </div>
        </div>
    </div>
</main>

<!-- SECTION: Présentation -->
<div class="offers-section">
    <h1>Pourquoi choisir Portal Job ?</h1>
    <p class="p-pres">Portal Job est bien plus qu’un simple site d’offres d’emploi. 
       C’est une plateforme moderne pensée pour faciliter la rencontre entre talents et entreprises. 
       Nous mettons en avant les métiers d’avenir et accompagnons aussi bien les candidats que les recruteurs dans leur évolution professionnelle.</p>
    <ul class="pres-ul">
        <li class="pres-il">✅ Accédez à des offres exclusives publiées chaque jour</li>
        <li class="pres-il">🚀 Profitez d’un espace personnel intuitif pour gérer vos candidatures</li>
        <li class="pres-il">💼 Collaborez avec des entreprises innovantes dans toute la France</li>
        <li class="pres-il">🌍 Découvrez les possibilités de télétravail ou de postes internationaux</li>
    </ul>
</div>

<!-- SECTION: Avantages -->
<div class="offers-section">
    <h1>Les avantages de notre plateforme</h1>
    <div class="offers-grid">
        <div class="offer-card">
            <img src="assets/images/p1.jpg" alt="Facilité d'utilisation">
            <h3>Facile d'utilisation</h3>
            <p>Une interface claire et rapide pour postuler ou publier une offre en quelques clics.</p>
        </div>
        <div class="offer-card">
            <img src="/assets/images/p2.jpg" alt="Sécurité des données">
            <h3>Sécurité & Confidentialité</h3>
            <p>Vos données sont protégées. Nous mettons la transparence et la confiance au cœur de notre démarche.</p>
        </div>
        <div class="offer-card">
            <img src="/assets/images/p3.jpg" alt="Évolution professionnelle">
            <h3>Évolution professionnelle</h3>
            <p>Accédez à des formations, des conseils de carrière et des outils pour booster votre profil.</p>
        </div>
    </div>
</div>


<!-- SECTION: Dernières offres -->
<div class="offers-section">
    <h1>Nos offres en ligne</h1>
    <div class="offers-grid">
        <?php foreach ($LastOffers3 as $offer): ?>
            <div class="offer-card">
                <img class="offer-image" src="<?= htmlspecialchars($offer['image_url']) ?>" alt="Photo de l'offre">
                <div class="offer-content">
                    <h4><strong>POSTE : </strong><?= htmlspecialchars($offer["title"]) ?></h4>
                    <p class="contract"><strong>CONTRAT : </strong><?= htmlspecialchars($offer["contrat"]) ?></p>
                    <p class="location"><strong>LIEU : </strong><?= htmlspecialchars($offer["location"]) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="/connexion"><button class="cta-more">Voir Plus</button></a>
</div>