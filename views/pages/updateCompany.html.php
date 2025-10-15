<link rel="stylesheet" href="/assets/css/updateAll.css">

<div class="update-container">
    <div class="update-entete">
        <h1 class="update-title"><i class="fa-solid fa-pen-to-square"></i> MODIFIER LA SOCIÉTÉ !</h1>
        <p class="update-description">Mettez à jour les informations de la société ci-dessous</p>
    </div>

    <?php if (!isset($row)) : ?>
        <div class="update-error">Erreur de chargement des données.</div>
    <?php else : ?>
        <form method="POST" class="update-form" action="/company/updateCompany">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">

            <div class="form-group">
                <label for="inputNom" class="form-label">NOM</label>
                <input type="text" name="inputNom" id="inputNom" class="form-input" value="<?= $row['name'] ?>" required>
            </div>

            <div class="form-group">
                <label for="inputNbEmploye" class="form-label">NB EMPLOYÉS</label>
                <textarea name="inputNbEmploye" id="inputNbEmploye" class="form-textarea" rows="3" required><?= $row['number_of_employees'] ?></textarea>
            </div>

            <div class="form-group">
                <label for="inputDomaine" class="form-label">DOMAINE</label>
                <textarea name="inputDomaine" id="inputDomaine" class="form-textarea" rows="3" required><?= $row['industry'] ?></textarea>
            </div>

            <div class="form-group">
                <label for="inputAdresse" class="form-label">Adresse</label>
                <input type="text" name="inputAdresse" id="inputAdresse" class="form-input" value="<?= $row['address'] ?>" required>
            </div>

            <div class="form-group">
                <label for="inputLatitude" class="form-label">LATITUDE</label>
                <input type="text" name="inputLatitude" id="inputLatitude" class="form-input" value="<?= $row['latitude'] ?>" required>
            </div>

            <div class="form-group">
                <label for="inputLongitude" class="form-label">LONGITUDE</label>
                <input type="text" name="inputLongitude" id="inputLongitude" class="form-input" value="<?= $row['longitude'] ?>" required>
            </div>

            <div class="form-group">
                <label for="inputDescription" class="form-label">DESCRIPTION</label>
                <input type="text" name="inputDescription" id="inputDescription" class="form-input" value="<?= $row['description'] ?>" required>
            </div>

            <div class="form-group">
                <label for="inputSiret" class="form-label">N_SIRET</label>
                <input type="text" name="inputSiret" id="inputSiret" class="form-input" value="<?= $row['n_siret'] ?>" required>
            </div>

            <?php $isAdmin = isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'admin'; ?>
            <div class="form-group">
                <label for="inputLogo" class="form-label">LOGO</label>
                <input type="text" name="inputLogo" id="inputLogo" class="form-input" value="<?= $row['logo'] ?>" <?= $isAdmin ? '' : 'disabled' ?>>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-update"
                    onclick="return confirm('Es-tu sûr de vouloir supprimer cette Société ?')" title="Modifier">💾 Mettre à jour</button>
            </div>

            <?php if (isset($_GET['success'])): ?>
                <script>
                    alert("✅ La Société a bien été mise à jour !");
                    window.location.href = "company";
                </script>
            <?php endif; ?>
        </form>
    <?php endif; ?>
</div>