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
    $result = $query->fetch();
    require_once('close.php');

    // header("Location: index.php");
}

if ($_POST) {
    if (
        isset($_POST['game_name']) && isset($_POST['game_date']) && isset($_POST['game_desc']) && isset($_POST['game_photo']) && isset($_POST['cate_name'])
    ) {
        print_r($_POST);
        require('connect.php');
        $game_name = strip_tags($_POST['game_name']);
        $game_date = $_POST['game_date'];
        $game_desc = $_POST['game_desc'];
        $game_photo = $_POST['game_photo'];
        $cate_name = $_POST['cate_name'];
        $sql = "UPDATE games SET game_name = :game_name, game_date = :game_date, game_desc = :game_desc, game_photo = :game_photo, cate_name = :cate_name WHERE game_id=$id";
        $query = $db->prepare($sql);
        $query->bindValue(':game_name', $game_name);
        $query->bindValue(':game_date', $game_date);
        $query->bindValue(':game_desc', $game_desc);
        $query->bindValue(':game_photo', $game_photo);
        $query->bindValue(':cate_name', $cate_name);

        $query->execute();
        require('close.php');
        header("Location:backoffice.php");
    }
}
// else {
//     header("Location: index.php");
// }

?>



<h1>Modifier un jeu</h1>
<form method="post">
    <div>
        <label for="game_name">Nom du jeu</label><input name="game_name" value="<?= $result["game_name"] ?>" type="text">
        <label for="game_date">Date de sortie</label>
        <input type="date" name="game_date" value="<?= $result["game_date"] ?>" required>
        <label for="game_desc">Description</label><input name="game_desc" value="<?= $result["game_desc"] ?>" type="text">
        <label for="game_photo">Jacquette</label><input name="game_photo" value="<?= $result["game_photo"] ?>" type="text">
        <div class="select">

            <label for="cate_name">Catégorie</label>
            <select name="cate_name" value="<?= $result["cate_name"] ?>" required>
                <option value="RPG">RPG</option>
                <option value="FPS">FPS</option>
                <option value="MMO">MMO</option>
                <option value="Strategie">Stratégie</option>
                <option value="Simulation">Simulation</option>
                <option value="Survival Horror">Survival Horror</option>

            </select>


        </div>
        <input type="submit" value="Modifier" class="sub">
</form>
</main>