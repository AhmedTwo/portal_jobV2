<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal-Job | <?= $title ?></title>

    <link href="assets/css/styles.css" rel="stylesheet">

</head>

<body>

    <?php
    if ($title !== "Connexion / Inscription" && $title !== "Ajout d'utilisateur" && $title !== "Ajout Entreprise" && $title !== "Accueil") {
        require_once './views/partials/header.php';
    }

    if (
        $title == "Connexion / Inscription" || $title == "Ajout d'utilisateur"
    ) {
        require_once './views/partials/headerOne.php';
    }
    ?>
    <?= $content; ?>
    <?php

    if ($title !== "Accueil") {
        require_once './views/partials/footer.php';
    } ?>
</body>

</html>