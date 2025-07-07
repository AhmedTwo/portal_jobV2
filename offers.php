<?php
session_start();
$offer = true;
require_once 'controllers/OfferController.php';

$offerController = new OfferController;

$offerController->index($pdo);
