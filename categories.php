<?php

$_GET["id"];
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require("connect.php");
    $id = strip_tags($_GET['id']);
    require('close.php');
}


require("connect.php");
$sql = "SELECT *
FROM games
INNER JOIN categories ON games.cate_name = categories.cat_name
WHERE categories.id = $id";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
require("close.php");
$title = "Jeux" . " " . $result[0]['cate_name'];


/* echo "<pre>";
var_dump($result);
echo "</pre>"; */

?>

<?php
include("header.php");
include("navbar.php"); ?>

<section class="sectionCate">
    <h1 class="cate_name">Jeux <?= $result[0]['cate_name'] ?></h1>
</section>

<div class="game-container">


    <?php
    //pour chaque résultat de $result, on affiche une ligne dans le tableau
    foreach ($result as $jeu) {
        // print_r($stagiaire);
    ?>

        <a class="game-card" href="jeu.php?id=<?= $jeu['game_id'] ?>">

            <img src="<?= $jeu['game_cover'] ?>" alt="">
            <div class="card-info">

                <div class="article-info">
                    <p>Article ajouté le <?= $jeu["added"] ?></p>
                    <p>Par <?= $jeu["user_name"] ?></p>
                </div>
                <div class="game-info">
                    <p> <?= $jeu['game_name'] ?> </p>
                    <p>Date de sortie: <?= $jeu['game_date'] ?> </p>
                    <br>
                </div>
                <p>Cliquer pour voir plus</p>
            </div>

        </a>



    <?php
    };

    ?>
</div>

<?php include_once("footer.php"); ?>