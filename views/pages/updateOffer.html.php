<div>
    <div>
        <h1><i class="fa-solid fa-pen-to-square"></i> Modifier l'offre</h1>
        <p>Mettez à jour les informations de l'offre ci-dessous</p>
    </div>

    <?php if (!isset($row)) : ?>
        <div>Erreur de chargement des données.</div>
    <?php else : ?>

        <form method="POST">
            <input type="hidden" name="myid" value="<?= $row['id'] ?>">

            <div>
                <div>
                    <label for="inputTitre">Titre</label>
                    <input type="text" name="inputTitre" id="inputTitre" value="<?= $row['title'] ?>">
                </div>

                <div>
                    <label for="inputPoste">Poste</label>
                    <input type="text" name="inputPoste" id="inputPoste" value="<?= $row['category'] ?>">
                </div>

                <div>
                    <label for="inputAdresse">Adresse</label>
                    <input type="text" name="inputAdresse" id="inputAdresse" value="<?= $row['location'] ?>">
                </div>

                <div>
                    <label for="inputContrat">Type de contrat</label>
                    <select id="inputContrat" name="inputContrat">
                        <option selected><?= $row["contrat"]; ?></option>
                        <?php foreach ($contrat as $ligne): ?>
                            <option value="<?= $ligne["id_contrat"]; ?>"><?= $ligne["name"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="inputMission">Mission</label>
                    <textarea name="inputMission" id="inputMission" rows="4"><?= $row['mission'] ?></textarea>
                </div>

                <div>
                    <label for="inputDescription">Description</label>
                    <textarea name="inputDescription" id="inputDescription" rows="4"><?= $row['description'] ?></textarea>
                </div>

                <div>
                    <label for="inputTechnologie">Technologie(s)</label>
                    <input type="text" name="inputTechnologie" id="inputTechnologie" value="<?= $row['technologies_used'] ?>">
                </div>

                <div>
                    <label for="inputPositif">Points positifs</label>
                    <textarea name="inputPositif" id="inputPositif" rows="2"><?= $row['benefits'] ?></textarea>
                </div>

                <div>
                    <label for="inputNombreParticipant">Nombre de participants</label>
                    <input type="number" name="inputNombreParticipant" id="inputNombreParticipant" value="<?= $row['participants_count'] ?>">
                </div>

                <?php
                // definir ici la variable de la date sera plus simple pour la reutilisation ensuite
                $today = date('Y-m-d');
                ?>
                <div>
                    <label for="inputDateCreation">Date de création</label>
                    <input type="date" name="inputDateCreation" id="inputDateCreation" required min="<?= $today ?>" max="<?= $today ?>">
                </div>

                <!-- isset veut dire existe -->
                <?php $isAdmin = isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'admin'; ?>
                <div>
                    <!-- le rendre disable pour autre que l'admin -->
                    <label for="inputImage">Image (URL)</label>
                    <input type="text" name="inputImage" id="inputImage" value="<?= $row['image_url'] ?>" <?= $isAdmin ? '' : 'disabled' ?>>
                </div>

                <div>
                    <button type="submit">💾 Mettre à jour</button>
                </div>

                <?php if (isset($_GET['success'])): ?>
                    <script>
                        alert("✅ L'offre a bien été mise à jour !");
                        window.location.href = "offers.php";
                    </script>
                <?php endif; ?>


            </div>
        </form>
    <?php endif; ?>
</div>