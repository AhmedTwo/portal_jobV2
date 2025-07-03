<?php
session_start();
$profil = true;
require_once 'controllers/UserController.php';

$userController = new UserController;

$userController->index($pdo);
