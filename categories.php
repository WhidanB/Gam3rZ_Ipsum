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
INNER JOIN categories ON games.cat_name = categories.cat_name
WHERE categories.id = $id";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
require("close.php");

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

    <table>

        <?php
        //pour chaque résultat de $result, on affiche une ligne dans le tableau
        foreach ($result as $jeu) {
            // print_r($stagiaire);
        ?>

            <tr>
                <td>
                    <a href="jeu.php?id=<?= $jeu['game_id'] ?>">
                        <?= $jeu['game_name'] ?> </a>
                </td>


            </tr>

        <?php
        };

        ?>
    </table>
</body>

</html>