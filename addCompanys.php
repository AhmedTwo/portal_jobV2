<?php
session_start();
require_once __DIR__ . '/controllers/CompanyController.php';

$addCompanyController = new CompanyController;

$addCompanyController->addCompany($pdo);
