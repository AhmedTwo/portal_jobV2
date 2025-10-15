<link rel="stylesheet" href="/assets/css/updateAll.css">

<div class="update-container">
    <div class="update-entete">
        <h1 class="update-title"><i class="fa-solid fa-pen-to-square"></i> MODIFIER L'OFFRE !</h1>
        <p class="update-description">Mettez à jour les informations de l'offre ci-dessous</p>
    </div>

    <?php if (!isset($row)) : ?>
        <div class="update-error">Erreur de chargement des données.</div>
    <?php else : ?>

        <form method="POST" class="update-form" action="/offers/updateOffer">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">

            <div class="form-group">
                <label for="inputTitre" class="form-label">Titre</label>
                <input type="text" name="inputTitre" id="inputTitre" class="form-input" value="<?= $row['title'] ?>">
            </div>

            <div class="form-group">
                <label for="inputPoste" class="form-label">Poste</label>
                <input type="text" name="inputPoste" id="inputPoste" class="form-input" value="<?= $row['category'] ?>">
            </div>

            <div class="form-group">
                <label for="inputAdresse" class="form-label">Adresse</label>
                <input type="text" name="inputAdresse" id="inputAdresse" class="form-input" value="<?= $row['location'] ?>">
            </div>

            <div class="form-group">

                <label for="inputContrat" class="form-label">Type de contrat</label>

                <select id="inputContrat" name="inputContrat" class="form-select" required>

                    <?php foreach ($contrat as $ligne): ?>

                        <option value="<?= $ligne["id_contrat"]; ?>"

                            <?= ($ligne["name"] === $row["contrat"]) ? "selected" : "" ?>>
                            <!-- on compare le nom du contrat affiché avec celui actuellement enregistré dans l’offre. 
                             Si c’est égal, on ajoute selected à l’<option> correspondante ✅-->

                            <?= htmlspecialchars($ligne["name"]) ?>
                            <!-- htmlspecialchars() protège contre les caractères spéciaux -->

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group">
                <label for="inputMission" class="form-label">Mission</label>
                <textarea name="inputMission" id="inputMission" class="form-textarea" rows="4"><?= $row['mission'] ?></textarea>
            </div>

            <div class="form-group">
                <label for="inputDescription" class="form-label">Description</label>
                <textarea name="inputDescription" id="inputDescription" class="form-textarea" rows="4"><?= $row['description'] ?></textarea>
            </div>

            <div class="form-group">
                <label for="inputTechnologie" class="form-label">Technologie(s)</label>
                <input type="text" name="inputTechnologie" id="inputTechnologie" class="form-input" value="<?= $row['technologies_used'] ?>">
            </div>

            <div class="form-group">
                <label for="inputPositif" class="form-label">Points positifs</label>
                <textarea name="inputPositif" id="inputPositif" class="form-textarea" rows="2"><?= $row['benefits'] ?></textarea>
            </div>

            <div class="form-group">
                <label for="inputNombreParticipant" class="form-label">Nombre de participants</label>
                <input type="number" name="inputNombreParticipant" id="inputNombreParticipant" class="form-input" value="<?= $row['participants_count'] ?>">
            </div>

            <?php $today = date('Y-m-d'); ?>
            <div class="form-group">
                <label for="inputDateCreation" class="form-label">Date de création</label>
                <input type="date" name="inputDateCreation" id="inputDateCreation" class="form-input" required min="<?= $today ?>" max="<?= $today ?>" value="<?= $today ?>">
            </div>

            <?php $isAdmin = isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'admin'; ?>
            <div class="form-group">
                <label for="inputImage" class="form-label">Image (URL)</label>
                <input type="text" name="inputImage" id="inputImage" class="form-input" value="<?= $row['image_url'] ?>" <?= $isAdmin ? '' : 'readonly' ?>>
                <!-- readonly garde le champ non modifiable mais il est bien envoyé en POST. -->
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-update"
                    onclick="return confirm('Es-tu sûr de vouloir modifier cette offre ?')" title="Modifier">💾 Mettre à jour</button>
            </div>

            <?php if (isset($_GET['success'])): ?>
                <script>
                    alert("✅ L'offre a bien été mise à jour !");
                    window.location.href = "offers";
                </script>
            <?php endif; ?>
        </form>

    <?php endif; ?>
</div>