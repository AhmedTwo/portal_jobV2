<?php

if (!empty($_GET["idC"])) {
    $query = "delete from company where id=:id";
    $objstmt = $pdo->prepare($query);
    $objstmt->execute(["id" => $_GET["idC"]]);
    $objstmt->closeCursor();
    header("Location: /dashboard");
}

if (!empty($_GET["idU"])) {
    $query = "delete from users where id=:id";
    $objstmt = $pdo->prepare($query);
    $objstmt->execute(["id" => $_GET["idU"]]);
    $objstmt->closeCursor();
    header("Location: /dashboard");
}

if (!empty($_GET["idD"])) {
    $query = "delete from request where id=:id";
    $objstmt = $pdo->prepare($query);
    $objstmt->execute(["id" => $_GET["idD"]]);
    $objstmt->closeCursor();
    header("Location: /dashboard");
}
