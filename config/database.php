<?php

$dsn = "mysql:host=localhost;dbname=job_portal;charset=utf8";
$username = "root";
$password = "";

try {
    // tente si ca marche
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    // si jamais ca casse tu fait ca (intercepte l'erreur)
    echo "Connexion échouée!" . $e->getMessage();
}
