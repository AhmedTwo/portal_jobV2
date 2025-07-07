<?php
session_start();
require_once 'controllers/CompanyController.php';

if (!isset($_GET['id'])) {
    die("Offre introuvable !");
}

$id = (int) $_GET['id'];


$CompanyController = new CompanyController;

$CompanyController->show($pdo, $id);
