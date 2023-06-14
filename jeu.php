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
$sql = "SELECT * FROM screenshots WHERE game = '$title'";
$query = $db->prepare($sql);
$query->execute();
$image = $query->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM screenshots WHERE game = '$title'";
$query = $db->prepare($sql);
$query->execute();
$screen = $query->fetchAll(PDO::FETCH_ASSOC);


require_once('close.php');


include("header.php");
include("navbar.php");
?>

<div class="overlay"></div>
<div class="modal">
    <div class="slider">
        <div class="slider_nav">
            <button onclick="previous()" style="display: none;" class="slider_nav_button slider_nav_prev"><svg width="30" height="30" fill="none" stroke="#2b2b2b" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2a10 10 0 1 0 0 20 10 10 0 1 0 0-20z"></path>
                    <path d="m12 8-4 4 4 4"></path>
                    <path d="M16 12H8"></path>
                </svg></button>
            <button onclick="next()" class="slider_nav_button slider_nav_next"><svg width="30" height="30" fill="none" stroke="#2b2b2b" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2a10 10 0 1 0 0 20 10 10 0 1 0 0-20z"></path>
                    <path d="m12 16 4-4-4-4"></path>
                    <path d="M8 12h8"></path>
                </svg></button>
        </div>
        <div class="slider_content">
            <?php
            foreach ($image as $image) {
            ?>
                <div class="slider_content_item">
                    <img src="<?= $image["images"] ?>" alt="">
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>


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
                    foreach ($screen as $screen) {

                    ?>

                        <img data-id="<?= $screen["id"] ?>" class="screen" src="<?= $screen["images"] ?>" alt="">
                    <?php } ?>
                </div>
            </div>
        </section>







    <?php
    };

    ?>
</div>
<script src="search.js"></script>
<script src="index.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<?php include("footer.php"); ?>