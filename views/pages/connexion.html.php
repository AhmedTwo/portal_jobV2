<!-- 
Ceci ma servi a hasher les mdp que je souhaitais car j'avais fais un insert into depuis ma bdd
Donc ensuite jai généré le mdp hasher et mis à jour dans la table

$password = 'amazonmdp';
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash;
die; 

-->

<?php
$error = $_SESSION['error'] ?? '';
// affectation avec un opérateur de coalescence nulle (??)
// Si $_SESSION['error'] existe et n’est pas null, alors donne sa valeur à $error, sinon donne une chaîne vide ''.
unset($_SESSION['error']); // supprime la variable de session error juste après l’avoir utilisée.
?>

<?php if (!empty($error)): ?>
    <div><?= $error ?></div>
<?php endif; ?>

<div>
    <div>
        <div>
            <h1>CONNEXION</h1>
            <form action="/includes/connexion.php" method="POST">
                <div>
                    <label for="inputEmail">Email</label>
                    <input type="email" name="inputEmail" id="inputEmail">
                </div>
                <div>
                    <label for="inputMdp">Mot de passe</label>
                    <input type="password" name="inputMdp" id="inputMdp">
                </div>
                <div>
                    <input type="checkbox" id="rememberMe">
                    <label for="rememberMe">
                        Se souvenir de moi !
                    </label>
                </div>
                <div>
                    <button type="submit">Se connecter</button>
                </div>
                <div>
                    <p>Vous n'avez pas de compte ? <a href="addUsers.php">Inscription !</a></p>
                    <p>Vous êtes une Société ? <a href="applyCompany.php">Rejoignez-nous !</a></p>
                </div>
            </form>
        </div>
    </div>
</div>