<?php

session_start();
require("connect.php");
$sql = "SELECT * FROM categories";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$title = "Accueil";

include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <section class="section1">
        <video autoplay loop muted>
            <source src="./assets/main.mp4">
        </video>


        <h1 class="intro">La sélection des meilleurs jeux, par des geeks, pour des g33ks.</h1>

    </section>




    <section class="section2">
        <h2>Les catégories</h2>
        <div class="cate-container">

            <?php
            //pour chaque résultat de $result, on affiche une ligne dans le tableau
            foreach ($result as $categorie) {
                // print_r($stagiaire);
            ?>
                <a href="categories.php?id=<?= $categorie['id'] ?>">
                    <div class="categorie" style="background-image: url(<?= $categorie['cat_photo'] ?>); background-size: cover;">
                        <div class="link-container">
                            <h2><?= $categorie['cat_name'] ?></h2>
                        </div>
                    </div>
                </a>
            <?php
            };

            ?>
        </div>
    </section>

    <?php include_once("footer.php"); ?>