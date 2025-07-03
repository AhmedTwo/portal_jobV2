<?php
session_start();
$inscription = true;
require_once __DIR__ . '/controllers/UserController.php';

$addUserController = new UserController;

$addUserController->addUsers($pdo);
