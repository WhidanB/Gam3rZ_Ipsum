<?php
session_start();

if ($_SESSION["user"]["role"] != "admin") {
    header("Location:backoffice.php");
}

$_GET["id"];
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once("connect.php");

    $id = strip_tags($_GET['id']);
    $sql = "SELECT * FROM users WHERE user_id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();
    require_once('close.php');

    // header("Location: index.php");
}

if ($_POST) {
    if (
        isset($_POST['user_name'])
    ) {
        require('connect.php');
        // $user_id = strip_tags($_POST['user_id']);
        $user_name = strip_tags($_POST['user_name']);
        $user_mail = $_POST['user_mail'];
        $user_role = $_POST['user_role'];
        $sql = "UPDATE users SET user_name = :user_name, user_mail = :user_mail, user_role = :user_role WHERE user_id = $id";
        $query = $db->prepare($sql);
        // $query->bindValue(':user_id', $user_id);
        $query->bindValue(':user_name', $user_name);
        $query->bindValue(':user_mail', $user_mail);
        $query->bindValue(':user_role', $user_role);


        $query->execute();

        print_r($user_role);
        require('close.php');
        header("Location:users.php");
    }
}

?>



<h1>Modifier un jeu</h1>
<form method="post">
    <div>
        <!-- <input type="hidden" name="user_id" value=""> -->
        <label for="user_name">Pseudo de l'utilisateur</label><input name="user_name" value="<?= $result["user_name"] ?>" type="text">
        <label for="user_mail">Adresse mail</label>
        <input type="mail" name="user_mail" value="<?= $result["user_mail"] ?>" required>
        <!-- <label for="user_role">Role</label><input name="user_role" value="" type="text"> -->

        <select name="user_role" id="user_role">
            <option value="user">user</option>
            <option value="admin">admin</option>
        </select>

        <input type="submit" value="Modifier" class="sub">
</form>
</main>