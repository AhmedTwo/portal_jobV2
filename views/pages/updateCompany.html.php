<div>

    <h2>Modifier une compagnie</h2>

    <?php if (!isset($row)) : ?>
        <div>Erreur de chargement des données.</div>
    <?php else : ?>

        <form method="POST">
            <input type="hidden" name="myid" value="<?= $row['id'] ?>">

            <div>
                <label for="inputNom">NOM</label>
                <input type="text" name="inputNom" id="inputNom" value="<?= $row['name'] ?>" required>
            </div>

            <div>
                <label for="inputNbEmploye">NB EMPLOYÉS</label>
                <textarea name="inputNbEmploye" id="inputNbEmploye" rows="3" required><?= $row['number_of_employees'] ?></textarea>
            </div>

            <div>
                <label for="inputDomaine">DOMAINE</label>
                <textarea name="inputDomaine" id="inputDomaine" rows="3" required><?= $row['industry'] ?></textarea>
            </div>

            <div>
                <label for="inputAdresse">Adresse</label>
                <input type="text" name="inputAdresse" id="inputAdresse" value="<?= $row['address'] ?>" required>
            </div>

            <div>
                <label for="inputLatitude">LATITUDE</label>
                <input type="text" name="inputLatitude" id="inputLatitude" value="<?= $row['latitude'] ?>" required>
            </div>

            <div>
                <label for="inputLongitude">LONGITUDE</label>
                <input type="text" name="inputLongitude" id="inputLongitude" value="<?= $row['longitude'] ?>" required>
            </div>

            <div>
                <label for="inputDescription">DESCRIPTION</label>
                <input type="text" name="inputDescription" id="inputDescription" value="<?= $row['description'] ?>" required>
            </div>

            <div>
                <label for="inputSiret">N_SIRET</label>
                <input type="text" name="inputSiret" id="inputSiret" value="<?= $row['n_siret'] ?>" required>
            </div>

            <!-- isset veut dire existe -->
            <?php $isAdmin = isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'admin'; ?>
            <div>
                <label for="inputLogo">LOGO</label>
                <input type="text" name="inputLogo" id="inputLogo" value="<?= $row['logo'] ?>" <?= $isAdmin ? '' : 'disabled' ?>>
            </div>

            <div>
                <button type="submit">
                    💾 Mettre à jour
                </button>
            </div>
        </form>

    <?php endif; ?>
</div>