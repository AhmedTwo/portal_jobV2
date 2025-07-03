<?php
session_start();
require_once dirname(__DIR__) . '/config/database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["inputEmail"];
    $password = md5($_POST["inputMdp"]);

    $query = "SELECT * FROM users WHERE email = :email";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(['email' => $email]);
    $user = $pdostmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password === $user['password']) {
        $_SESSION['new_id'] = $user['id'];
        $_SESSION['new_email'] = $user['email'];
        $_SESSION['new_nom'] = $user['nom'];
        $_SESSION['new_role'] = $user['role'];

        header('Location: /accueil.php');
        exit;
    } else if (!empty($email) && !empty($_POST["inputMdp"])) {
        $_SESSION['error'] = "L'identifiant et/ou mot de passe est incorrect !";
    } else {
        $_SESSION['error'] = "Les champs sont vides, veuillez les remplir !";
    }

    header('Location: /connexion.php');
    exit;
}
