<?php


$_GET["id"];
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once("connect.php");

    $id = strip_tags($_GET['id']);
    $sql = "SELECT * FROM games WHERE game_id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    require_once('close.php');
}

?>

<table>

    <?php
    //pour chaque résultat de $result, on affiche une ligne dans le tableau
    foreach ($result as $jeu) {

        var_dump($jeu);
        // print_r($stagiaire);
    ?>

        <tr>
            <td><?= $jeu['game_name'] ?></td>
            <td><?= $jeu['game_date'] ?></td>
            <td><?= $jeu['game_desc'] ?></td>
        </tr>

    <?php
    };

    ?>
</table>