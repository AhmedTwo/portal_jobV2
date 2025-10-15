<?php
$role = $_SESSION['new_role'] ?? null;
?>

<link rel="stylesheet" href="/assets/css/updateAll.css">

<h1 class="update-title"><i class="fa-solid fa-pen-to-square"></i> MODIFIER MON PROFIL</h1>

<div class="update-container">
    <div class="update-entete text-center">
        <img class="photo" src="<?= htmlspecialchars($row['photo']) ?>" alt="Photo Utilisateur">
        <p class="update-description">Mettez à jour vos informations personnelles ci-dessous</p>
    </div>

    <?php if (!isset($row)) : ?>
        <div class="update-error">
            <p>Erreur de chargement des données.</p>
            <p>Vous devez être connecté pour accéder à cette page.</p>
            <a href="/connexion" class="btn btn-primary">Se connecter</a>
        </div>
    <?php else : ?>

        <form method="POST"
            class="update-form bg-light p-5 shadow rounded-4"
            action="/dashboard/updateUser/<?= $row['id'] ?>">
            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
            <!--champ caché=hidden input transmet quand même une donnée au serveur et cest ce qui permet a mon controller de faire la verif ensuite apres le try-->

            <div class="row g-4">
                <div class="col-md-6 form-group">
                    <label for="inputNom" class="form-label">NOM</label>
                    <input type="text" class="form-input form-control" name="inputNom" id="inputNom"
                        value="<?= htmlspecialchars($row['nom']) ?>" required>
                </div>

                <div class="col-md-6 form-group">
                    <label for="inputPrenom" class="form-label">PRÉNOM</label>
                    <input type="text" class="form-input form-control" name="inputPrenom" id="inputPrenom"
                        value="<?= htmlspecialchars($row['prenom']) ?>" required>
                </div>

                <div class="col-md-6 form-group">
                    <label for="inputTel" class="form-label">TELEPHONE</label>
                    <input type="text" class="form-input form-control" name="inputTel" id="inputTel"
                        value="<?= htmlspecialchars($row['telephone']) ?>" required>
                </div>

                <div class="col-md-6 form-group">
                    <label for="inputCity" class="form-label">VILLE</label>
                    <input type="text" class="form-input form-control" name="inputCity" id="inputCity"
                        value="<?= htmlspecialchars($row['ville']) ?>" required>
                </div>

                <div class="col-md-6 form-group">
                    <label for="inputZipcode" class="form-label">CODE POSTAL</label>
                    <input type="text" class="form-input form-control" name="inputZipcode" id="inputZipcode"
                        value="<?= htmlspecialchars($row['code_postal']) ?>" required>
                </div>

                <div class="col-md-6 form-group">
                    <label for="inputDispo" class="form-label">DISPONIBILITEES (0 pour NON / 1 pour OUI) </label>
                    <input type="text" class="form-input form-control" name="inputDispo" id="inputDispo"
                        value="<?= htmlspecialchars($row['disponibilite']) ?>" required>
                </div>

                <div class="text-end mt-4 form-actions">
                    <a href="javascript:history.back()" class="btn-return" style="text-decoration: none; margin: 1%;">Annuler</a>
                    <!--javascript:history.back() demande au navigateur de retourner à la page précédente dans l’historique.-->
                    <button type="submit" class="btn-update"
                        onclick="return confirm('Êtes-vous sûr de vouloir modifier votre profil ?')"
                        title="Modifier">💾 Mettre à jour</button>
                </div>

            </div>
        </form>
    <?php endif; ?>
</div>