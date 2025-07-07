<?php
session_start();
$dashboard = true;
require_once 'controllers/CompanyController.php';

$UserController = new CompanyController;

$UserController->indexAll($pdo);
