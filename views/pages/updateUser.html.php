<div class="container my-5">
    <div class="text-center mb-7">
        <h1 class="display-4 fw-bold text-primary"><i class="fa-solid fa-pen-to-square"></i> Modifier l'user</h1>
        <p class="lead text-muted">Mettez à jour les informations du user ci-dessous</p>
    </div>

    <?php if (!isset($row)) : ?>
        <div class="alert alert-danger text-center">Erreur de chargement des données.</div>
    <?php else : ?>
        <form method="POST" class="bg-light p-5 shadow rounded-4">
            <input type="hidden" name="myid" value="<?= $row['id'] ?>">

            <div class="row g-4">
                <div class="col-md-6">
                    <label for="inputNom" class="form-label fw-semibold">NOM</label>
                    <input type="text" class="form-control form-control-lg" name="inputNom" id="inputNom" value="<?= $row['nom'] ?>">
                </div>

                <div class="col-md-6">
                    <label for="inputPrenom" class="form-label fw-semibold">PRENOM</label>
                    <input type="text" class="form-control form-control-lg" name="inputPrenom" id="inputPrenom" value="<?= $row['prenom'] ?>">
                </div>

                <div class="col-md-6">
                    <label for="inputEmail" class="form-label fw-semibold">EMAIL</label>
                    <input type="email" class="form-control form-control-lg" name="inputEmail" id="inputEmail" value="<?= $row['email'] ?>">
                </div>

                <div class="col-12">
                    <label for="inputMdp" class="form-label fw-semibold">MOT DE PASSE</label>
                    <textarea class="form-control form-control-lg" name="inputMdp" id="inputMdp"><?= $row['password'] ?></textarea>
                </div>

                <div class="col-md-6">
                    <label for="inputRole" class="form-label fw-semibold">RÔLE</label>
                    <input type="text" class="form-control form-control-lg" name="inputRole" id="inputRole" value="<?= $row['role'] ?>">
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="fa-solid fa-floppy-disk"></i> Mettre à jour
                    </button>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>