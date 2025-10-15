<link rel="stylesheet" href="/assets/css/addOffers.css">

<div id="containerFirst">
    <div id="containerSecond">
  <h1 class="h1Add">AJOUT D'UNE NOUVELLE OFFRE</h1>

  <form id="addForm" action="/offers/addOffers" method="POST" class="offer-form">

    <div class="divAdd">
      <label for="inputTitre" >TITRE</label>
      <input type="text" id="inputTitre" name="inputTitre" class="input" required>
    </div>

    <div class="divAdd">
      <label for="inputDescription" >DESCRIPTION</label>
      <input type="text" id="inputDescription" name="inputDescription" class="input" required>
    </div>

    <div class="divAdd">
      <label for="inputMission" >MISSION</label>
      <input type="text" id="inputMission" name="inputMission" class="input" required>
    </div>

    <div class="divAdd">
      <label for="inputAdresse" >ADRESSE</label>
      <input type="text" id="inputAdresse" name="inputAdresse" class="input" required>
    </div>

    <div class="divAdd">
      <label for="inputPoste" >POSTE</label>
      <input type="text" id="inputPoste" name="inputPoste" class="input" required>
    </div>

    <div class="divAdd">
      <label for="inputEntreprise" >SOCIETE</label>
      <select id="inputEntreprise" name="inputEntreprise" class="select" required>
        <option value="" disabled selected>-- Sélectionnez une entreprise --</option>
        <?php foreach ($NameCompany as $ligne): ?>
          <option value="<?= $ligne["id_company"]; ?>"><?= htmlspecialchars($ligne["name"]) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="divAdd">
      <label for="inputContrat" >CONTRAT</label>
      <select id="inputContrat" name="inputContrat" class="select" required>
        <option value="" disabled selected>-- Sélectionnez un contrat --</option>
        <?php foreach ($contrat as $ligne): ?>
          <option value="<?= $ligne["id_contrat"]; ?>"><?= htmlspecialchars($ligne["name"]) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="divAdd">
      <label for="inputTechnologie" >TECHNOLOGIE UTILISEE</label>
      <input type="text" id="inputTechnologie" name="inputTechnologie" class="input" required>
    </div>

    <div class="divAdd">
      <label for="inputPositif" >POINTS POSITIFS</label>
      <input type="text" id="inputPositif" name="inputPositif" class="input" required>
    </div>

    <?php
    // definir ici la variable de la date sera plus simple pour la reutilisation ensuite
    $today = date('Y-m-d');
    ?>

    <div class="divAdd">
      <label for="inputDateCreation" >DATE CREATION</label>
      <input type="date" id="inputDateCreation" name="inputDateCreation" class="input" required min="<?= $today ?>" max="<?= $today ?>">
    </div>

    <div class="divAdd">
      <label for="inputImage" >IMAGE URL</label>
      <input type="text" id="inputImage" name="inputImage" class="input" required>
    </div>

    
      <button type="submit" class="btn">Ajouter</button>

  </form>
</div>
</div>

<script>
  document.getElementById('offerForm').addEventListener('submit', function(e) {
    // Vérifie si tous les champs sont valides (le navigateur le fait aussi, mais on vérifie ici pour afficher l'alerte seulement si tout est ok)
    if (this.checkValidity()) {
      alert('Votre Offre a bien été ajoutée !');
    } else {
      // Le navigateur va bloquer l'envoi tout seul, donc pas besoin d'empêcher ici
    }
  });
</script>