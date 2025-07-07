<div>
  <h1>Ajout d'une nouvelle Offre</h1>

  <form method="POST">

    <div>
      <label for="inputTitre">TITRE</label>
      <input type="text" id="inputTitre" name="inputTitre" required>
    </div>

    <div>
      <label for="inputDescription">DESCRIPTION</label>
      <input type="text" id="inputDescription" name="inputDescription" required>
    </div>

    <div>
      <label for="inputMission">MISSION</label>
      <input type="text" id="inputMission" name="inputMission" required>
    </div>

    <div>
      <label for="inputAdresse">ADRESSE</label>
      <input type="text" id="inputAdresse" name="inputAdresse" required>
    </div>

    <div>
      <label for="inputPoste">POSTE</label>
      <input type="text" id="inputPoste" name="inputPoste" required>
    </div>

    <div>
      <label for="inputEntreprise">ENTREPRISE</label>
      <select id="inputEntreprise" name="inputEntreprise" required>
        <option value="" disabled selected>-- Sélectionnez une entreprise --</option>
        <?php foreach ($NameComapany as $ligne): ?>
          <option value="<?= $ligne["id_company"]; ?>"><?= htmlspecialchars($ligne["name"]) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div>
      <label for="inputContrat">CONTRAT</label>
      <select id="inputContrat" name="inputContrat" required>
        <option value="" disabled selected>-- Sélectionnez un contrat --</option>
        <?php foreach ($contrat as $ligne): ?>
          <option value="<?= $ligne["id_contrat"]; ?>"><?= htmlspecialchars($ligne["name"]) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div>
      <label for="inputTechnologie">TECHNOLOGIE</label>
      <input type="text" id="inputTechnologie" name="inputTechnologie" required>
    </div>

    <div>
      <label for="inputPositif">POSITIFS</label>
      <input type="text" id="inputPositif" name="inputPositif" required>
    </div>

    <?php
    // definir ici la variable de la date sera plus simple pour la reutilisation ensuite
    $today = date('Y-m-d');
    ?>
    <div>
      <label for="inputDateCreation">DATE CREATION</label>
      <input type="date" id="inputDateCreation" name="inputDateCreation" required min="<?= $today ?>" max="<?= $today ?>">
    </div>

    <div>
      <label for="inputImage">IMAGE URL</label>
      <input type="text" id="inputImage" name="inputImage" required>
    </div>

    <div>
      <button type="submit">Ajouter</button>
    </div>

  </form>
</div>