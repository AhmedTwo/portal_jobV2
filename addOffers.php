<?php
session_start();
require_once __DIR__ . '/controllers/OfferController.php';

$addOfferController = new OfferController;

$addOfferController->addOffers($pdo);
