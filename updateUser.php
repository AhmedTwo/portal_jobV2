<?php
session_start();
require_once 'controllers/UserController.php';

$UserController = new UserController;

$UserController->update($pdo);
