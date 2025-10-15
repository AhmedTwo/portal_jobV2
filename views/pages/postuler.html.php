<link rel="stylesheet" href="/assets/css/applyOffer.css">

<div class="apply-container">
    <h1 class="apply-title">POSTULER MAINTENANT !</h1>

    <!-- Ici on utilise la variable $offer envoyée par le contrôleur -->
    <form method="POST" action="/offers/offerDetails/apply?id=<?= htmlspecialchars($offer['id']) ?>" enctype="multipart/form-data">

        <div class="motivation-field">
            <label for="inputMotivation" class="field-label">MOTIVATION :</label>
            <textarea rows="6" cols="50"
                placeholder="Veuillez décrire en quelques lignes votre motivation qui sera vue par l'employeur"
                class="textarea"
                id="inputMotivation"
                name="inputMotivation"
                required></textarea>
        </div>

        <div class="upload-section">
            <div class="file-field">
                <label for="inputLettre" class="field-label">IMPORTER VOTRE LETTRE DE MOTIVATION (.PDF) :</label>
                <input type="file"
                    class="file-input"
                    name="inputLettre"
                    id="inputLettre"
                    accept=".pdf">
            </div>

            <button type="submit" class="send-btn">Envoyer</button>
        </div>
    </form>
</div>