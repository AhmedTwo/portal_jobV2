<!-- les requests doit être vu que par l'admin ? -->

<?php
session_start();
$demande = true;
require_once 'controllers/HomeController.php';

$HomeController = new HomeController;

$HomeController->addRequest($pdo);
