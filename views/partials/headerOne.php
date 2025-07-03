<header>
    <nav>
        <a href="/index.php" class="logo">PORTAL-JOB</a>
        <div class="auth-buttons">
            <a class="logo" <?php echo !empty($connexion) ? "active" : "" ?> href="connexion.php"><button class="login">CONNEXION</button></a>

            <a class="logo" <?php echo !empty($inscription) ? "active" : "" ?> href="addUsers.php"><button class="signup">INSCRIPTION</button></a>
        </div>
    </nav>
</header>