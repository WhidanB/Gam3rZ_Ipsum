<?php


$_GET["id"];
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once("connect.php");

    $id = strip_tags($_GET['id']);
    $sql = "SELECT * FROM ampoules WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();
    require_once('close.php');
    $_SESSION['data'] = $result;
    var_dump($_SESSION);
    header("Location: index.php?id=$id");
} else {
    header("Location: index.php");
}
