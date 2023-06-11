<?php

$_GET["id"];
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once("connect.php");


    $id = strip_tags($_GET['id']);
    $sql = "SELECT * FROM screenshots WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $screen = $query->fetchAll(PDO::FETCH_ASSOC);

    $game = $screen[0]["game"];


    $sql = "SELECT * FROM games WHERE game_name = '$game'";
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    $image = $screen[0]["images"];
    unlink($image);


    $sql = "DELETE FROM screenshots WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();




    var_dump($result);

    header("Location: edit.php?id=" . $result[0]["game_id"]);
}
