<div>
    <h1>Ajout d'une Demande</h1>

    <form method="POST">
        <div>
            <label for="inputNom">TITRE</label>
            <input type="text" id="inputTitre" name="inputTitre" required>
        </div>
        <div>
            <label for="inputDescription">DESCRIPTION</label>
            <textarea id="inputDescription" name="inputDescription" rows="6" cols="50" required></textarea>
        </div>
        <div>
            <label for="inputType">TYPE</label>
            <select id="inputType" name="inputType" required>
                <option value="rien"></option>
                <option value="reclamation">Réclamation</option>
                <option value="demande_informations">Demande d'informations</option>
                <option value="suppression">Suppression</option>
                <option value="modification">Modification</option>
            </select>
        </div>
        <div>
            <button type="submit">Ajouter</button>
        </div>
    </form>
</div>