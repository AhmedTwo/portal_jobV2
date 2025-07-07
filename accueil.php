<?php
session_start();
$accueil = true;
require_once 'controllers/OfferController.php';

$OfferController = new OfferController;

$OfferController->index3($pdo);
