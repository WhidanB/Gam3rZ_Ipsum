<?php
session_start();

if ($_SESSION["user"]["role"] != "admin") {
    header("Location:backoffice.php");
}

require_once("connect.php");

$sql = "SELECT * from users";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
require_once("close.php");
$title = "Table des utilisateurs";
include("headerAdd.php");


?>


<section class="container container-fluid d-flex flex-column justify-content-center align-items-center">
    <h1 class="m-2">Table des utilisateurs</h1>
    <div class="m-2 container-fluid col-xl-4 cl-md-8 col-xs-12">
        <a class="btn btn-primary" href="index.php">Accueil</a>
        <a class="btn btn-primary" href='backoffice.php'>Backoffice</a>
    </div>
    <table class="border">
        <th class="p-2 text-center border border-black text-white bg-dark">Pseudo</th>
        <th class="p-2 text-center border border-black text-white bg-dark">Adresse mail</th>
        <th class="p-2 text-center border border-black text-white bg-dark">Role</th>
        <th class="p-2 text-center border border-black text-white bg-dark">Actions</th>
        <?php

        foreach ($result as $user) {
        ?>
            <tr>
                <td class="px-2 text-center border border-black"><?= $user["user_name"] ?></td>
                <td class="px-2 text-center border border-black"><?= $user["user_mail"] ?></td>
                <td class="px-2 text-center border border-black"><?= $user["user_role"] ?></td>
                <td class="px-2 text-center border border-black">
                    <div class="btn-group">
                        <div class="btn-group">

                            <a href="useredit.php?id=<?= $user['user_id'] ?>" aria-label="Close" class="btn btn-primary active">Éditer
                            </a>
                            <button data-id="<?= $user["user_id"] ?>" type="button" class="btn btn-primary delBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">Supprimer</button>

                        </div>
                    </div>
                </td>
            </tr>
        <?php
        };
        ?>
    </table>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ALERTE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voulez vous vraiment supprimer cet utilisateur ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary confirmDel">Confirmer</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="modal2.js"></script>