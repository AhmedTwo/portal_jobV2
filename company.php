<?php
session_start();
$company = true;
require_once 'controllers/CompanyController.php';

$companyController = new CompanyController;

$companyController->index($pdo);
