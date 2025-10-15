<?php $activePage = null; ?>

<link rel="stylesheet" href="/assets/css/header_footer.css">

<header id="headerOne">
    <nav id="navOne">
        <div class="nav-left">
            <a href="/" class="logo">
                <img src="/assets/images/logo_portal_job.png" alt="Logo">
            </a>
        </div>

        <div class="nav-right">
            <div class="user-info">
                <a class="<?= $activePage === 'connexion' ? 'active' : '' ?>" href="/connexion">
                    <button class="sign_in">CONNEXION</button>
                </a>
                <a class="<?= $activePage === 'inscription' ? 'active' : '' ?>" href="/inscription/addUser/">
                    <button class="sign_up">INSCRIPTION</button>
                </a>
            </div>
        </div>
    </nav>
</header>