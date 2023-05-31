<?php

session_start();


if (!isset($_SESSION["user"])) {
    header("Location: index.php");
} else {

    require("connect.php");
    if ($_SESSION["user"]["role"] = "admin") {
        $sql = "SELECT * FROM games";
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    } else
    if ($_SESSION["user"]["role"] = "user") {
        $name = $_SESSION["user"]["pseudo"];
        $sql = "SELECT * FROM games WHERE user_name = '$name'";
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    $title = "BackOffice";
    include "header.php";
    include "navbar.php";
    include "footer.php";
}
?>


<a href="add.php">Ajouter un jeu</a>


<table>

    <?php
    //pour chaque résultat de $result, on affiche une ligne dans le tableau
    foreach ($result as $jeu) {
        // print_r($stagiaire);
    ?>

        <tr>
            <td><?= $jeu["game_name"] ?></td>
            <td>

                <a href="edit.php?id=<?= $jeu['game_id'] ?>" class="modif">
                    <svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg></a>
                <a href="delete.php?id=<?= $jeu['game_id'] ?>" class="cross">
                    <svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </a>
            </td>
        </tr>

    <?php
    };

    ?>
</table>