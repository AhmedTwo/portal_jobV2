<!-- 
Ceci ma servi a hasher les mdp que je souhaitais car j'avais fais un insert into depuis ma bdd
Donc ensuite jai généré le mdp hasher et mis à jour dans la table -->

<!-- $password = 'ahmedmdp';
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash;
die; -->

<link rel="stylesheet" href="/assets/css/connexion.css">

<div id="containerFirst">
    <img src='/assets/images/imagePortal.png' alt='fond logo portal job' class='background-logo'>
    <div id="containerSecond">
        <h1 class="h1Login">CONNEXION &nbsp;&nbsp;<img src='/assets/images/Portal.png' alt='fond logo porte de portal job' width="35"></h1>
        <!-- &nbsp; me permet de faire un espace en html -->

        <!-- Messages de session juste en dessous du H1 -->
        <!-- Vérifie si la variable de session "error" existe et n'est pas vide -->
        <?php if (!empty($_SESSION['error'])): ?>
            <!-- Sécurise et affiche le contenu du message d'erreur -->
            <div class="alert-message error" style="color: red; text-align: center; padding: 0.5rem;">
                <?= htmlspecialchars($_SESSION['error']) ?></div>
            <!-- Supprime la variable de session "error" après l'affichage -->
        <?php unset($_SESSION['error']);
        endif; ?> <!-- Termine la condition if -->

        <form id="loginForm" action="/connexion" method="POST">
            <div class="divLogin">
                <label for="inputEmail">Email :</label>
                <input type="email" name="inputEmail" id="inputEmail" placeholder="&nbsp;exemple@gmail.com">
            </div>
            <div class="divLogin">
                <label for="inputMdp">Mot de passe :</label>
                <input type="password" name="inputMdp" id="inputMdp" placeholder="&nbsp;********">
                <p><a href="/connexion/passwordForget">Mot de passe oublié ?</a></p>
            </div>

            <div id="inscri_apply">
                <p>Vous n'avez pas de compte ? <a href="/inscription/addUser/">Inscription !</a></p>
                <p>Vous êtes une Société ? <a href="/connexion/applyCompany">Rejoignez-nous !</a></p>
                <br>
            </div>
            <button type="submit" id="sign_in">SE CONNECTER</button>
        </form>

    </div>
</div>