<link rel="stylesheet" href="/assets/css/applyCompany.css">

<div id="containerFirst">
<div id="containerSecond">
    <h1 class="h1AddCompany">AJOUT D'UNE NOUVELLE SOCIÉTÉ !</h1>

    <!-- Utiliser une URL absolue avec un / au début
    garantit que le POST sera envoyé à la bonne route, et donc que ce bloc sera bien déclenché  -->
    <form id="addCompanyForm" method="POST" action="/connexion/applyCompany" onsubmit="return validerSiret()">
        <div class="divAdd">
            <label for="inputNom">NOM DE LA SOCIÉTÉ</label>
            <input type="text" id="inputNom" name="inputNom" required>
        </div>
        <div class="divAdd">
            <label for="inputNbEmploye">NOMBRE EMPLOYEES</label>
            <input type="text" id="inputNbEmploye" name="inputNbEmploye" required>
        </div>
        <div class="divAdd">
            <label for="inputDomaine">DOMAINE</label>
            <input type="text" id="inputDomaine" name="inputDomaine" required>
        </div>
        <div class="divAdd">
            <label for="inputAdresse">ADRESSE POSTALE</label>
            <input type="text" id="inputAdresse" name="inputAdresse" required>
        </div>
        <div class="divAdd">
            <label for="inputLatitutde">LATITUDE</label>
            <input type="text" id="inputLatitutde" name="inputLatitutde" required>
        </div>
        <div class="divAdd">
            <label for="inputLongitude">LONGITUDE</label>
            <input type="text" id="inputLongitude" name="inputLongitude" required>
        </div>
        <div class="divAdd">
            <label for="inputDescription">DESCRIPTIF</label>
            <input type="text" id="inputDescription" name="inputDescription" required>
        </div>
        <div class="divAdd">
            <label for="inputEmail">EMAIL</label>
            <input type="email" id="inputEmail" name="inputEmail" required>
        </div>
        <div class="divAdd">
            <!-- inputmode="numeric" → pavé numérique sur smartphone
                 pattern="\d{14}" → exactement 14 chiffres
                 maxlength="14" → limite de saisie -->
            <label for="inputSiret">N_SIRET</label>
            <input type="text" id="inputSiret" name="inputSiret"
                inputmode="numeric"
                pattern="\d{14}"
                maxlength="14"
                required>
        </div>

        <div class="divAdd">
            <label for="inputLogo">LIEN DU LOGO</label>
            <input type="text" id="inputLogo" name="inputLogo" required>
        </div>

        <div class="divAdd">
            <label for="inputLogo">NOM</label>
            <input type="text" id="inputFirstName" name="inputFirstName" required>
        </div>

        <div class="divAdd">
            <label for="inputLogo">PRENOM</label>
            <input type="text" id="inputLastName" name="inputLastName" required>
        </div>

        <div class="divAdd">
            <label for="telephone">TELEPHONE</label>
            <input type="text" id="telephone" name="inputTelephone" required>
        </div>

        <div class="divAdd">
            <label for="ville">VILLE</label>
            <input type="text" id="ville" name="inputVille" required>
        </div>

        <div class="divAdd">
            <label for="zipcode">CODE POSTAL</label>
            <input type="text" id="zipcode" name="inputZipcode" required>
        </div>

        <div class="divAdd">
            <label for="photo">PHOTO DE PROFIL :</label>
            <input type="file" id="photo" name="inputPhoto" accept=".pdf, .jpg, .png" required>
        </div>

            <button type="submit" class="btn"
                onclick="return confirm('Es-tu sûr de vouloir envoyer cette société à Admin ?')"
                title="Envoyer">ENVOYER</button>

    </form>
    </div>
</div>

<script>
    function validerSiret() {
        const siret = document.getElementById("inputSiret").value;
        // console.log("SIRET saisi :", siret);

        const regex = /^\d{14}$/;
        if (!regex.test(siret)) {
            alert("Le numéro SIRET doit contenir exactement 14 chiffres.");
            return false;
        }

        return true;
    }
</script>