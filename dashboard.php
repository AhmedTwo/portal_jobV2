<?php
session_start();
$dashboard = true;
require_once 'controllers/UserController.php';

$UserController = new UserController;

$UserController->indexAll($pdo);
