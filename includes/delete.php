<?php
include_once("../config/database.php");

if (!empty($_GET["idO"])) {
    $query = "delete from job_offers where id=:id";
    $objstmt = $pdo->prepare($query);
    $objstmt->execute(["id" => $_GET["idO"]]);
    $objstmt->closeCursor();
    header("Location: /offers.php");
}

if (!empty($_GET["idC"])) {
    $query = "delete from company where id=:id";
    $objstmt = $pdo->prepare($query);
    $objstmt->execute(["id" => $_GET["idC"]]);
    $objstmt->closeCursor();
    header("Location: /company.php");
}

if (!empty($_GET["idU"])) {
    $query = "delete from users where id=:id";
    $objstmt = $pdo->prepare($query);
    $objstmt->execute(["id" => $_GET["idU"]]);
    $objstmt->closeCursor();
    header("Location:../views/pages/UsersAdmin.html.php");
}

if (!empty($_GET["idD"])) {
    $query = "delete from request where id=:id";
    $objstmt = $pdo->prepare($query);
    $objstmt->execute(["id" => $_GET["idD"]]);
    $objstmt->closeCursor();
    header("Location: /request.php");
}
