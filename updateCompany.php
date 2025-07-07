<?php
session_start();
require_once 'controllers/CompanyController.php';

$CompanyController = new CompanyController;

$CompanyController->update($pdo);
