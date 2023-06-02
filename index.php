<?php

session_start();
require("connect.php");
$sql = "SELECT * FROM categories";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$title = "Accueil";

include "navbar.php";
include "footer.php";


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


    <h1>LOREM SES MORTS</h1>
    <video autoplay loop muted>
        <source src="./assets/main.mp4">
    </video>




    <section>
        <h2>Les catégories</h2>
        <div class="cate-container">

            <?php
            //pour chaque résultat de $result, on affiche une ligne dans le tableau
            foreach ($result as $categorie) {
                // print_r($stagiaire);
            ?>

                <div class="categorie" style="background-image: url(<?= $categorie['cat_photo'] ?>); background-size: cover;">
                    <div class="link-container">
                        <a href="categories.php?id=<?= $categorie['id'] ?>"><?= $categorie['cat_name'] ?></a>
                    </div>
                </div>

            <?php
            };

            ?>
        </div>
    </section>