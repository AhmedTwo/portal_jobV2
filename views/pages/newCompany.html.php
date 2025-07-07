<div>
    <br>
    <br>
    <h1>AJOUT D'UNE NOUVELLE SOCIETE</h1>

    <form method="POST" action="../../includes/traitement_formulaire.php">
        <div>
            <label for="inputNom">NOM DE LA SOCIETE</label>
            <input type="text" id="inputNom" name="inputNom" required>
        </div>
        <div>
            <label for="inputNbEmploye">NOMBRE EMPLOYEES</label>
            <input type="text" id="inputNbEmploye" name="inputNbEmploye" required>
        </div>
        <div>
            <label for="inputDomaine">DOMAINE</label>
            <input type="text" id="inputDomaine" name="inputDomaine" required>
        </div>
        <div>
            <label for="inputAdresse">ADRESSE POSTALE</label>
            <input type="text" id="inputAdresse" name="inputAdresse" required>
        </div>
        <div>
            <label for="inputLatitutde">LATITUDE</label>
            <input type="text" id="inputLatitutde" name="inputLatitutde" required>
        </div>
        <div>
            <label for="inputLongitude">LONGITUDE</label>
            <input type="text" id="inputLongitude" name="inputLongitude" required>
        </div>
        <div>
            <label for="inputDescription">DESCRIPTIF</label>
            <input type="text" id="inputDescription" name="inputDescription" required>
        </div>
        <div>
            <label for="inputEmail">EMAIL</label>
            <input type="email" id="inputEmail" name="inputEmail" required>
        </div>
        <div>
            <!-- inputmode="numeric" : sa affiche un pavé numérique sur smartphone
             pattern="\d{14}" → exactement 14 chiffres.
             maxlength="14" → max 14 caractères tapés. -->
            <label for="inputSiret">N_SIRET</label>
            <input type="text" id="inputSiret" name="inputSiret"
                inputmode="numeric"
                pattern="\d{14}"
                maxlength="14"
                onclick="return confirm('Le numéro SIRET doit contenir exactement 14 chiffres')" required>
        </div>
        <div>
            <label for="inputLogo">LIEN DU LOGO</label>
            <input type="text" id="inputLogo" name="inputLogo" required>
        </div>
        <div>
            <button type="submit">Ajouter</button>
        </div>
    </form>
</div>