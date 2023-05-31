<?php
session_start();

if ($_POST) {
    if (
        isset($_POST['game_name']) && isset($_POST['game_date']) && isset($_POST['game_desc']) && isset($_POST['game_photo']) && isset($_POST['cate_name'])


    ) {
        print_r($_POST);
        require('connect.php');
        $game_name = strip_tags($_POST['game_name']);
        $game_date = $_POST['game_date'];
        $game_desc = strip_tags($_POST['game_desc']);
        $game_photo = $_POST['game_photo'];
        $cate_name = $_POST['cate_name'];
        $added = DATE('Y/m/d');
        $user_name = $_SESSION["user"]["pseudo"];
        $sql = "INSERT INTO games (game_name, game_date, game_desc, game_photo, cate_name, added, user_name ) VALUES (:game_name, :game_date, :game_desc, :game_photo, :cate_name, :added, :user_name)";
        $query = $db->prepare($sql);
        $query->bindValue(':game_name', $game_name);
        $query->bindValue(':game_date', $game_date);
        $query->bindValue(':game_desc', $game_desc);
        $query->bindValue(':game_photo', $game_photo);
        $query->bindValue(':cate_name', $cate_name);
        $query->bindValue(':added', $added);
        $query->bindValue(':user_name', $user_name);
        var_dump($added);
        var_dump($user_name);
        $query->execute();
        require('close.php');
        header("Location: backoffice.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

    <main>


        <h1>Ajouter un jeu</h1>
        <form method="post">
            <div>
                <label for="game_name">Nom du jeu</label><input name="game_name" type="text">
                <label for="game_date">Date de sortie</label>
                <input type="date" name="game_date" required>
                <label for="game_desc">Description</label><input name="game_desc" type="text">
                <label for="game_photo">Jacquette</label><input name="game_photo" type="text">
                <div class="select">

                    <label for="cate_name">Catégorie</label>
                    <select name="cate_name" required>
                        <option value="RPG">RPG</option>
                        <option value="FPS">FPS</option>
                        <option value="MMO">MMO</option>
                        <option value="Strategie">Stratégie</option>
                        <option value="Simulation">Simulation</option>
                        <option value="Survival Horror">Survival Horror</option>

                    </select>


                </div>
                <input type="submit" value="Ajouter" class="sub">
        </form>
    </main>
</body>

</html>