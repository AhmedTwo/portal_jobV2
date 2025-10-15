<link rel="stylesheet" href="/assets/css/password.css">

<div id="containerFirst">
<div id="containerSecond">
<h1 class="h1Forget">Mot de passe oublié &nbsp;&nbsp;<img src='/assets/images/Portal.png' alt='fond logo porte de portal job' width="35"></h1>

<p>Entrez votre <span class="spanEmail">adresse mail</span> pour recevoir un 
<span class="spanNewPassword">nouveau mot de passe</span> sur votre boite mail :</p>

        <!-- Messages de session juste en dessous du H1 -->
        <!-- Vérifie si la variable de session "error" existe et n'est pas vide -->
                <?php if (!empty($_SESSION['error'])):?>
                <!-- Sécurise et affiche le contenu du message d'erreur -->
                <div style="color: red; text-align: center; padding: 0.5rem;">
                <?= htmlspecialchars($_SESSION['error']) ?></div>
                 <!-- Supprime la variable de session "error" après l'affichage -->
                <?php unset($_SESSION['error']);
                endif; ?> <!-- Termine la condition if -->

        <!-- Vérifie si la variable de session "success" existe et n'est pas vide -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div id="successMessage" style="color: green; text-align: center; padding: 0.5rem;">
                <?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

<form id="loginForm" method="POST" action="/connexion/passwordForget">
    <div class="divLogin">
    <label for="inputEmail">Adresse email :</label><br>
    <input type="email" id="inputEmail" name="inputEmail" placeholder="&nbsp;exemple@gmail.com" required><br><br>
    </div>
    <button type="submit" class="sendButton">Envoi du nouveau mot de passe</button>
</form>

</div>
</div>