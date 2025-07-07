<header>
    <nav>
        <div>

            <!-- Vérifie si l'utilisateur est connecté en testant l'existence de $_SESSION['new_nom'].
            Si oui, affiche "Bonjour, [nom de l'utilisateur]". Sinon, affiche "Bonjour, invité !" -->

            <h2><?php if (isset($_SESSION['new_nom'])): ?>
                    <span class="navbar-text text-white me-3">
                        Bonjour, <?= htmlspecialchars($_SESSION['new_nom']) ?> !
                    </span>
                <?php else: ?>
                    <span class="navbar-text text-white me-3">
                        Bonjour, invité !
                    </span>
                <?php endif; ?>
            </h2>
            <div id="navbarCollapse">
                <ul>
                    <li>
                        <a <?php echo !empty($accueil) ? "active" : "" ?> aria-current="page" href="accueil.php">ACCUEIL</a>
                    </li>

                    <li>
                        <a <?php echo !empty($offer) ? "active" : "" ?> aria-current="page" href="offers.php">NOS OFFERS</a>
                    </li>

                    <li>
                        <a <?php echo !empty($company) ? "active" : "" ?> href="company.php">NOS SOCIETEES</a>
                    </li>

                    <?php if (isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'admin'): ?>
                        <li>
                            <a <?php echo !empty($dashboard) ? "active" : "" ?> href="dashboard.php">DASHBOARD</a>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a <?php echo !empty($demande) ? "active" : "" ?> href="request.php">DEMANDES</a>
                    </li>

                    <li>
                        <a <?php echo !empty($profil) ? "active" : "" ?> href="profil.php">PROFIL</a>
                    </li>

                    <li>
                        <a <?php echo !empty($contact) ? "active" : "" ?> href="contact.php">CONTACT</a>
                    </li>
                </ul>
                <div>
                    <a href="../../includes/deconnexion.php"><button type="submit">SE DECONNECTER</button></a>
                </div>
            </div>
        </div>
    </nav>
</header>