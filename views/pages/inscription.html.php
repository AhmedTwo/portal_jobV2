<div>
    <br><br><br><br>
    <form method="POST" action="../../includes/inscription.php" enctype="multipart/form-data">
        <div>
            <label for="inputNom">NOM </label>
            <div>
                <input type="text" id="inputNom" name="inputNom" required>
            </div>
        </div>
        <div>
            <label for="inputPrenom">PRENOM </label>
            <div>
                <input type="text" id="inputPrenom" name="inputPrenom" required>
            </div>
        </div>
        <div>
            <label for="inputEmail">EMAIL </label>
            <div>
                <input type="email" id="inputEmail" name="inputEmail" required>
            </div>
        </div>
        <div>
            <label for="inputPassword">MOT DE PASSE</label>
            <div>
                <input type="password" id="inputPassword" name="inputPassword" required>
            </div>
        </div>
        <div>
            <label for="inputTelephone">TELEPHONE</label>
            <input type="text" id="inputTelephone" name="inputTelephone" required>
        </div>
        <div>
            <label for="inputVille">VILLE</label>
            <input type="text" id="inputVille" name="inputVille" required>
        </div>
        <div>
            <label for="inputZipcode">CODE POSTAL</label>
            <input type="text" id="inputZipcode" name="inputZipcode" required>
        </div>
        <div>
            <label for="inputQualification">QUALIFICATION</label>
            <input type="text" id="inputQualification" name="inputQualification" required>
        </div>
        <div>
            <label for="inputPreference">PREFERENCE</label>
            <input type="text" id="inputPreference" name="inputPreference" required>
        </div><br>
        <div style="border: 1px solid grey; padding : 1%;">
            <br>
            <label for="inputDisponibilite">DISPONIBILITE :</label>
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
        <div>
            <div>
                <label for="inputPhoto">Importer votre photo de profil :</label>
                <input type="file" name="inputPhoto" id="inputPhoto" accept=".pdf,.doc,.docx" required>
                <br>
                <label for="lettre"> Importer votre CV :</label>
                <input type="file" name="inputCv" id="inputCv" accept=".pdf,.doc,.docx" required>
            </div>
        </div>
        <button type="submit">S'INSCRIRE</button>
    </form>
</div>