<div class="container">
    <br><br><br><br>
    <form method="POST" action="addUsers.php" enctype="multipart/form-data">
        <div class="row mb-3">
            <label for="inputNom">NOM </label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputNom" name="inputNom" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPrenom">PRENOM </label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputPrenom" name="inputPrenom" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail">EMAIL </label>
            <div class="col-sm-5">
                <input type="email" class="form-control" id="inputEmail" name="inputEmail" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword">MOT DE PASSE</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" id="inputPassword" name="inputPassword" required>
            </div>
        </div>
        <div class="col-md-6">
            <label for="inputTelephone" class="form-label">TELEPHONE</label>
            <input type="text" class="form-control" id="inputTelephone" name="inputTelephone" required>
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
            <label for="inputQualification" class="form-label">QUALIFICATION</label>
            <input type="text" class="form-control" id="inputQualification" name="inputQualification" required>
        </div>
        <div class="col-md-6">
            <label for="inputPreference" class="form-label">PREFERENCES</label>
            <input type="text" class="form-control" id="inputPreference" name="inputPreference" required>
        </div><br>
        <div class="col-md-6" style="border: 1px solid grey; padding : 1%;">
            <br>
            <label for="inputDisponibilite" class="form-label">DISPONIBILITE IMMEDIATE :</label>
            <br>
            <label>
                <input type="radio" name="choix" value="1" required>
                OUI
            </label><br>
            <label>
                <input type="radio" name="choix" value="0" required>
                NON
            </label><br><br>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="inputPhoto" class="form-label">Importer votre photo de profil :</label>
                <input type="file" class="form-control" name="inputPhoto" id="inputPhoto" accept=".pdf, .jpg, .png" required>
                <br>
                <label for="lettre" class="form-label"> Importer votre CV :</label>
                <input type="file" class="form-control" name="inputCv" id="inputCv" accept=".pdf" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">S'INSCRIRE</button>
    </form>
</div>