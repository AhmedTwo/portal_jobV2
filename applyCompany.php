<?php
session_start();
require_once __DIR__ . '/controllers/CompanyController.php';

$postulerCompanyController = new CompanyController;

$postulerCompanyController->postulerCompany();
