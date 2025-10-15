<link rel="stylesheet" href="/assets/css/addRequest.css">

<h1>AJOUT D'UNE DEMANDE</h1>

<div class="container">
    <form id="requestForm" method="POST" action="<?= $type === 'myRequest' ? '/myRequest/addMyRequest' : '/request/addRequest' ?>">
        <!-- // ID du formulaire, utile pour le CSS ou JavaScript
        // Méthode d'envoi des données : POST envoie les données dans le corps de la requête
        // URL où les données seront envoyées lors de la soumission du formulaire
        // Ici, on utilise PHP pour choisir l'URL dynamiquement :
        // Si $type vaut 'myRequest', l'action sera '/myRequest/addMyRequest'
        // Sinon, l'action sera '/request/addRequest' -->

        <div>
            <label for="inputNom">TITRE</label>
            <input type="text" id="inputTitre" name="inputTitre" required>
        </div>

        <div>
            <label for="inputType">TYPE</label>
            <select id="inputType" name="inputType" required>
                <option value="RECLAMATION">Réclamation</option>
                <option value="DEMANDES">Demande d'informations</option>
                <option value="SUPPRESSION">Suppression</option>
                <option value="MODIFICATION">Modification</option>
            </select>
        </div>

        <div>
            <label for="inputDescription">DESCRIPTION</label>
            <textarea id="inputDescription" name="inputDescription" rows="6" cols="50" required></textarea>
        </div>
        <div>
            <button class="button" type="submit">AJOUTER</button>
        </div>
    </form>
</div>