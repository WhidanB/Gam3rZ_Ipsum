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

include("header.php");
include("navbar.php");
include("footer.php");
?>

<table>
    <th>Pseudo</th>
    <th>Adresse mail</th>
    <th>Role</th>
    <th>Actions</th>
    <?php

    foreach ($result as $user) {
    ?>
        <tr>
            <td><?= $user["user_name"] ?></td>
            <td><?= $user["user_mail"] ?></td>
            <td><?= $user["user_role"] ?></td>
            <td>
                <div class="btn-group">
                    <a href="useredit.php?id=<?= $user['user_id'] ?>" class="modif">
                        <svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg></a>
                    <a href="userdel.php?id=<?= $user['user_id'] ?>" class="cross">
                        <svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </a>
                </div>
            </td>
        </tr>
    <?php
    };
    ?>
</table>