<?php
session_start();
require_once 'controllers/OfferController.php';

$updateController = new OfferController;

$updateController->update($pdo);
