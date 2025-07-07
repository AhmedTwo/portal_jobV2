<?php
session_start();
$contact = true;
require_once './config/render.php';

render('contact', [
    "title" => "Contact"
]);
