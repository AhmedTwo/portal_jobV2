<div class="container">
    <br>
    <br>
    <h1 class="text-center m-5">Postuler Maintenant !</h1>

    <form class="row g-3" method="POST" action="../../includes/traitement_formulaire_postule.php?id=<?= $_GET['id'] ?>" enctype="multipart/form-data">
        <div class="col-md-6">
            <label for="inputNom" class="form-label">NOM</label>
            <input type="text" class="form-control" id="inputNom" name="inputNom" required>
        </div>
        <div class="col-md-6">
            <label for="inputPrenom" class="form-label">PRENOM</label>
            <input type="text" class="form-control" id="inputPrenom" name="inputPrenom" required>
        </div>
        <div class="col-md-6">
            <label for="inputTelephone" class="form-label">TELEPHONE</label>
            <input type="text" class="form-control" id="inputTelephone" name="inputTelephone" required>
        </div>
        <div class="col-md-6">
            <label for="inputEmail" class="form-label">EMAIL</label>
            <input type="text" class="form-control" id="inputEmail" name="inputEmail" required>
        </div>
        <div class="col-md-6">
            <label for="inputVille" class="form-label">VILLE</label>
            <input type="text" class="form-control" id="inputVille" name="inputVille" required>
        </div>
        <div class="col-md-6">
            <label for="inputZipcode" class="form-label">CODE POSTAL</label>
            <input type="text" class="form-control" id="inputZipcode" name="inputZipcode" required>
        </div>
        <div class="col-md-6">
            <label for="inputMotivation" class="form-label">MOTIVATION</label>
            <textarea rows="6" cols="50" placeholder="Veuillez vous décrire en quelques lignes votre motivation qui sera vu par l'employeur"
                class="form-control" id="inputMotivation" name="inputMotivation"></textarea>
        </div>

        <div class="col-12">
            <div class="mb-3">
                <label for="inputLettre" class="form-label">Importer votre Lettre de Motivation :</label>
                <input type="file" class="form-control" name="inputLettre" id="inputLettre" accept=".pdf,.doc,.docx">
                <br>
                <label for="lettre" class="form-label"> Importer votre CV :</label>
                <input type="file" class="form-control" name="inputCv" id="inputCv" accept=".pdf,.doc,.docx" required>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</div>