<?php
session_start();
$connexion = true;
require_once 'controllers/HomeController.php';

$homeController = new HomeController;

$homeController->indexOne();
