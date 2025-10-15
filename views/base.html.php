<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal-Job | <?= $title ?></title>
    <link rel="icon" type="image/png" href="/assets/images/Portal.png">
</head>

<body>

    <?php
    if (!empty($_SESSION['new_id'])) {
        require_once 'views/partials/header.php';
    } else {
        require_once 'views/partials/headerOne.php';
    }
    ?>
    <?= $content; ?>
    <?php require_once './views/partials/footer.php'; ?>
</body>

</html>