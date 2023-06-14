<?php


$_GET["search"];

if (isset($_GET["search"]) && !empty($_GET["search"])) {
    require("connect.php");

    $search = strip_tags($_GET['search']);
    $sql = "SELECT * FROM games  WHERE game_name LIKE '%$search%' ORDER BY game_date DESC";
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $title = "Recherche";


    require("close.php");
    include("header.php");
    include("navbar.php");
}

?>
<section class="sectionCate">
    <h1 class="cate_name">Recherche</h1>
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

<?php

include("footer.php");
