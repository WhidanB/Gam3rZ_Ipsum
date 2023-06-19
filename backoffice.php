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
    } else
    if ($_SESSION["user"]["role"] == "user") {
        $name = $_SESSION["user"]["pseudo"];
        $sql = "SELECT * FROM games WHERE user_name = '$name'";
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    $title = "BackOffice";
    include "headerAdd.php";
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<nav class="m-auto shadow-none d-flex justify-content-around flex-row align-items-center">
    <?php
    if ($_SESSION["user"]["role"] == "admin") {
        echo "<a class='btn btn-primary'  href='users.php'>Gestion des utilisateurs</a>";
    }
    ?>
    <a href="add.php" class="d-flex justify-content-center align-items-center btn btn-primary">Ajouter un jeu</a>
    <a class="btn btn-primary" href="index.php">Accueil</a>
</nav>
<div class="container col-md-6 d-flex flex-column justify-content-center align-items-center mt-5">

    <div class="table-responsive">
        <table class="table">
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
                            </a>
                            <button data-id="<?= $jeu["game_id"] ?>" type="button" class="btn btn-primary delBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">Supprimer</button>

                        </div>
                    </td>
                </tr>

            <?php
            };

            ?>
        </table>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ALERTE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voulez vous vraiment supprimer ce jeu ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary confirmDel">Confirmer</button>
            </div>
        </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="modal.js"></script>