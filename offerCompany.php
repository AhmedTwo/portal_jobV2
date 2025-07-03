<?php
session_start();
require_once 'controllers/OfferController.php';

$id = $_GET['id']; // ou alors une valeur que tu récupères depuis l’URL

$controller = new OfferController;
$controller->showCompanyOffers($pdo, $id);
