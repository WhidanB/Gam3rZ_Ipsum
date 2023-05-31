<?php

session_start();
require("connect.php");
$sql = "SELECT * FROM categories";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);


include "header.php";
include "navbar.php";
include "footer.php";


?>


    <a href="disconnect.php">déco</a>

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
