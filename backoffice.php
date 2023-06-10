<?php

session_start();




if (!isset($_SESSION["user"])) {
    header("Location: index.php");
} else {

    require("connect.php");
    if ($_SESSION["user"]["role"] == "admin") {
        $sql = "SELECT * FROM games";
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        echo "<a href='users.php'>Utilisateurs</a>";
    } else
    if ($_SESSION["user"]["role"] == "user") {
        $name = $_SESSION["user"]["pseudo"];
        $sql = "SELECT * FROM games WHERE user_name = '$name'";
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    $title = "BackOffice";
    include "header.php";
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<a href="add.php" class="d-flex justify-content-center align-items-center">Ajouter un jeu</a>



<div class="container-fluid  d-flex justify-content-center align-items-center">
    <div class="col-2">
        <table class="border">
            <thead>

                <th class="p-2 text-center border border-black text-white bg-dark">Jeu</th>
                <th class="p-2 text-center border border-black text-white bg-dark">Catégorie</th>
                <th class="p-2 text-center border border-black text-white bg-dark">Ajouté par</th>
                <th class="p-2 text-center border border-black text-white bg-dark">Actions</th>
            </thead>
            <?php
            foreach ($result as $jeu) {
            ?>

                <tr>
                    <td class="px-2 text-center border border-black"><?= $jeu["game_name"] ?></td>
                    <td class="px-2 text-center border border-black"><?= $jeu["cate_name"] ?></td>
                    <td class="px-2 text-center border border-black"><?= $jeu["user_name"] ?></td>
                    <td class="text-center border border-black">
                        <div class="btn-group">

                            <a href="edit.php?id=<?= $jeu['game_id'] ?>" aria-label="Close" class="btn btn-primary active">Éditer
                                <!-- <svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg> -->
                            </a>
                            <a href="delete.php?id=<?= $jeu['game_id'] ?>" class="btn btn-primary">Supprimer
                                <!-- <svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg> -->
                            </a>
                        </div>
                    </td>
                </tr>

            <?php
            };

            ?>
        </table>
    </div>
</div>

<?php
if (isset($_SESSION["edit"])) {
    if (isset($_SESSION["edit"]["toast"])) {
        if ($_SESSION["edit"]["toast"] == 1) {
            echo '<script type="text/javascript" src="toastedit.js">
                </script>';
        }
        unset($_SESSION["edit"]["toast"]);
    }
}



if (isset($_SESSION["del"])) {
    if (isset($_SESSION["del"]["toast"])) {
        if ($_SESSION["del"]["toast"] == 1) {
            echo '<script type="text/javascript" src="toastdel.js">
                </script>';
        }
        unset($_SESSION["del"]["toast"]);
    }
}



if (isset($_SESSION["add"])) {
    if (isset($_SESSION["add"]["toast"])) {
        if ($_SESSION["add"]["toast"] == 1) {
            echo '<script type="text/javascript" src="toastadd.js">
                </script>';
        }
        unset($_SESSION["add"]["toast"]);
    }
}
?>