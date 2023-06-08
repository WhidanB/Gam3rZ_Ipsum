<?php
session_start();


$_GET["id"];
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once("connect.php");

    $id = strip_tags($_GET['id']);
    $sql = "SELECT * FROM games WHERE game_id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
}
$title = $result[0]["game_name"];
$sql = "SELECT images FROM screenshots WHERE game = '$title'";
$query = $db->prepare($sql);

$query->execute();
$image = $query->fetchAll(PDO::FETCH_ASSOC);
require_once('close.php');


include("header.php");
include("navbar.php");
?>

<section class="sectionCate">
    <h1 class="cate_name"><?= $result[0]["game_name"] ?></h1>
</section>

<div class="game-container2">


    <?php
    //pour chaque résultat de $result, on affiche une ligne dans le tableau
    foreach ($result as $jeu) {
        // print_r($stagiaire);
    ?>


        <section class="game-section">

            <img src="<?= $jeu['game_cover'] ?>" alt="">
            <div class="card-info2">

                <div class="article-info">
                    <p>Article ajouté le <?= $jeu["added"] ?></p>
                    <p>Par <?= $jeu["user_name"] ?></p>
                </div>
                <div class="game-info2">

                    <p><span class="desc">Description :</span><?= " " . $jeu['game_desc'] ?></p>
                    <p>Date de sortie: <?= $jeu['game_date'] ?> </p>
                </div>
                <div class="game_photo">
                    <?php
                    foreach ($image as $screenshot) {
                    ?>
                        <img src="<?= $screenshot["images"] ?>" alt="">
                    <?php } ?>
                </div>
            </div>
        </section>





    <?php
    };

    ?>
</div>

<?php include_once("footer.php"); ?>