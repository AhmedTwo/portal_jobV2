<?php
$role = $_SESSION['new_role'] ?? null;
$prenom = $_SESSION['new_prenom'] ?? null;
$activePage = $activePage ?? null;
$initiale = $prenom ? strtoupper(substr($prenom, 0, 1)) : '?'; // afin de recup la premiere lettre
?>

<link rel="stylesheet" href="/assets/css/header_footer.css">

<header id="headerOne">
    <nav id="navOne">
        <!-- Logo -->
        <div class="nav-left">
            <a href="/accueil" class="logo">
                <img src="/assets/images/logo_portal_job.png" alt="Logo">
            </a>
        </div>

        <!-- Menu principal -->
        <ul class="menu">
            <li><a href="/accueil" class="<?= $activePage === 'accueil' ? 'active' : '' ?>">Accueil</a></li>

            <!-- Nos offres + sociétés -->
            <li class="dropdown">
                <a href="#">Nos services ▾</a>
                <ul class="dropdown-content">
                    <li><a href="/offers" class="<?= $activePage === 'offers' ? 'active' : '' ?>">Nos offres</a></li>
                    <li><a href="/company" class="<?= $activePage === 'company' ? 'active' : '' ?>">Nos sociétés</a></li>
                </ul>
            </li>

            <li><a href="/myRequest" class="<?= $activePage === 'request' ? 'active' : '' ?>">Mes demandes</a></li>

            <!-- Admin -->
            <?php if ($role === 'admin'): ?>
                <li class="dropdown">
                    <a href="#">Administration ▾</a>
                    <ul class="dropdown-content">
                        <li><a href="/dashboard" class="<?= $activePage === 'dashboard' ? 'active' : '' ?>">Dashboard</a></li>
                        <li><a href="/request" class="<?= $activePage === 'request' ? 'active' : '' ?>">Demandes</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            <!-- Company -->
            <?php if ($role === 'company'): ?>
                <li><a href="/dashboard_company" class="<?= $activePage === 'dashboard_company' ? 'active' : '' ?>">Dashboard</a></li>
            <?php endif; ?>
        </ul>

        <!-- Partie droite -->
        <div class="nav-right">
            <div class="user-info">
                <span class="user-greeting">
                    <?= htmlspecialchars($prenom ?? 'invité') ?>
                </span>

                <!-- Favoris -->
                <?php if ($role === 'client'): ?>
                    <a href="/favoris" class="heart-link" title="Mes favoris">❤</a>
                <?php endif; ?>

                <!-- Menu utilisateur (clic) -->
                <?php if ($prenom): ?>
                    <div class="user-dropdown">
                        <input type="checkbox" id="user-toggle" hidden>
                        <label for="user-toggle" class="user-circle"><?= $initiale ?></label>

                        <ul class="user-menu">
                            <?php if ($role === 'client'): ?>
                                <li><a href="/favoris">Favoris</a></li>
                            <?php endif; ?>
                            <li><a href="/profil">Profil</a></li>
                            <li><a href="/contact">Contact</a></li>
                            <hr>
                            <li><a href="/includes/deconnexion.php" class="logout-link">Se déconnecter</a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>