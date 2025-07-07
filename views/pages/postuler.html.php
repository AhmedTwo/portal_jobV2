<div class="container">
    <br>
    <br>
    <h1 class="text-center m-5">POSTULER MAINTENANT !</h1>

    <form class="row g-3" method="POST" action="../../includes/traitement_formulaire_postule.php?id=<?= $_GET['id'] ?>" enctype="multipart/form-data">
        <div class="col-md-6">
            <label for="inputMotivation" class="form-label">MOTIVATION</label>
            <textarea rows="6" cols="50" placeholder="Veuillez décrire en quelques lignes votre motivation qui sera vu par l'employeur"
                class="form-control" id="inputMotivation" name="inputMotivation"></textarea>
        </div>

        <div class="col-12">
            <div class="mb-3">
                <label for="inputLettre" class="form-label">IMPORTER VOTRE LETTRE DE MOTIVATION (.PDF):</label>
                <input type="file" class="form-control" name="inputLettre" id="inputLettre" accept=".pdf">
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</div>