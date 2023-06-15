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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<nav class="m-auto shadow-none d-flex justify-content-around align-items-center flex-column">
    <h1>Modifier un utilisateur</h1>
    <div class="m-2 container-fluid col-xl-4 cl-md-8 col-xs-12">
    <a class="btn btn-primary" href="index.php">Accueil</a>
    <a class="btn btn-primary" href='backoffice.php'>Backoffice</a>
        <form method="post">
            <div class="m-2 form-group">
                <!-- <input type="hidden" name="user_id" value=""> -->
                <label for="user_name">Pseudo de l'utilisateur</label>
                <input name="user_name" value="<?= $result["user_name"] ?>" type="text" class="form-control">
            </div>
            <div class="m-2 form-group">
                <label for="user_mail">Adresse mail</label>
                <input type="mail" name="user_mail" value="<?= $result["user_mail"] ?>" required class="form-control">
            </div>
            <!-- <label for="user_role">Role</label><input name="user_role" value="" type="text"> -->
            <div class="m-2 form-group">
                <label for="user_role">Rôle</label>
                <select name="user_role" id="user_role" class="form-control">
                <option value="Admin" <?php if ($result['user_role'] == 'admin') echo 'selected'; ?> >Admin</option>
                <option value="Utilisateur" <?php if ($result['user_role'] == 'user') echo 'selected'; ?> >Utilisateur</option>                
                </select>
            </div>
            <input type="submit" value="Modifier" class="btn btn-primary">
        </form>
    </div>
  