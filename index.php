<?php

session_start();
require("connect.php");
$sql = "SELECT * FROM categories";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="disconnect.php">déco</a>
    <a href="login.php">Login</a>

    <table>

        <?php
        //pour chaque résultat de $result, on affiche une ligne dans le tableau
        foreach ($result as $categorie) {
            // print_r($stagiaire);
        ?>

            <tr>
                <td><a href="categories.php?id=<?= $categorie['id'] ?>"><?= $categorie['cat_name'] ?></a></td>
            </tr>

        <?php
        };

        ?>
    </table>




    <?php var_dump($_SESSION["user"]); ?>
</body>

</html>