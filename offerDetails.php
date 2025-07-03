<?php
session_start();
require_once 'controllers/OfferController.php';

if (!isset($_GET['id'])) {
    die("Offre introuvable !");
}

$id = (int) $_GET['id'];


$offerController = new OfferController;

$offerController->show($pdo, $id);
