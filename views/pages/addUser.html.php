<link rel="stylesheet" href="/assets/css/inscription.css">

<div id="containerFirst">
    <div id="containerSecond">
        <h1 class="h1Add">INSCRIPTION</h1>

        <form id="addForm" method="POST" action="/inscription/addUser/" enctype="multipart/form-data">

            <div class="divAdd">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="inputNom" required>
            </div>

            <div class="divAdd">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="inputPrenom" required>
            </div>

            <div class="divAdd">
                <label for="email">Email</label>
                <input type="email" id="email" name="inputEmail" required>
            </div>

            <div class="divAdd">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="inputPassword" required>
            </div>

            <div class="divAdd">
                <label for="telephone">Téléphone</label>
                <input type="text" id="telephone" name="inputTelephone" required>
            </div>

            <div class="divAdd">
                <label for="ville">Ville</label>
                <input type="text" id="ville" name="inputVille" required>
            </div>

            <div class="divAdd">
                <label for="zipcode">Code postal</label>
                <input type="text" id="zipcode" name="inputZipcode" required>
            </div>

            <div class="divAdd">
                <label for="qualification">Qualification</label>
                <input type="text" id="qualification" name="inputQualification" required>
            </div>

            <div class="divAdd">
                <label for="preference">Préférences</label>
                <input type="text" id="preference" name="inputPreference" required>
            </div>

            <div class="divAdd radio-box">
                <p>Disponibilité immédiate :</p>
                <label><input type="radio" name="choix" value="1" required> Oui</label>
                <label><input type="radio" name="choix" value="0" required> Non</label>
            </div>

            <div class="divAdd">
                <label for="photo">Photo de profil :</label>
                <input type="file" id="photo" name="inputPhoto" accept=".jpg, .jpeg, .png" required>
                <label for="cv">CV :</label>
                <input type="file" id="cv" name="inputCv" accept=".pdf" required>
            </div>

            <button type="submit" class="btn">S'INSCRIRE</button>

        </form>
    </div>
</div>