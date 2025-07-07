<?php
session_start();
require_once __DIR__ . '/controllers/OfferController.php';

$postulerController = new OfferController;

$postulerController->postuler();