<?php

session_start();

if (isset($_SESSION["user"])) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    if (isset($_POST["user_mail"], $_POST["pass"]) && !empty($_POST["user_mail"]) && !empty($_POST["pass"])) {
        if (!filter_var($_POST["user_mail"], FILTER_VALIDATE_EMAIL)) {
            die("L'adresse mail est incorrecte");
        }
        require_once("connect.php");

        $sql = "SELECT * FROM users WHERE user_mail = :user_mail";
        $query = $db->prepare($sql);
        $query->bindValue(":user_mail", $_POST["user_mail"]);
        $query->execute();
        $user = $query->fetch();

        if (!$user) {
            die("L'utilisateur et/ou le mot de passe est incorrect");
        }

        if (!password_verify($_POST["pass"], $user["pass"])) {
            die("L'utilisateur et/ou le mot de passe est incorrect");
        }



        $_SESSION["user"] = [
            "id" => $user["user_id"],
            "pseudo" => $user["user_name"],
            "email" => $user["user_mail"],
            "role" => $user["user_role"]
        ];

        var_dump($_SESSION);

        header("Location: index.php");
    }
}

$title = "login";


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="./fonts/stylesheet.css">
    <link rel="stylesheet" href="style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="stylesheet" href="./fonts/stylesheet.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="media.css">

</head>

<body>
    <?php include "navbar.php"; ?>
    <section class="section1">
        <video class="video2" autoplay loop muted>
            <source src="./assets/main.mp4">
        </video>
        <div class="form-box">
            <div class="form-value">
                <form class="connect" method="post">
                    <h2>Connexion</h2>
                    <div class="inputbox">
                        <label for="user_mail">Adresse mail</label>
                        <input type="email" name="user_mail" required />
                    </div>
                    <div class="inputbox">
                        <label for="pass">Mot de passe</label>
                        <input type="password" name="pass" id="input" required />
                        <p id="warning"></p>
                    </div>
                    <div class="forget">
                        <label for="">
                            <a href="#">Mot de passe oublié</a>
                        </label>
                    </div>
                    <input type="submit" value="Connexion" class="sub">

                    <div class="formlogo">
                        <img src="./assets/Facebook - Original.svg" alt="logo de facebook">
                        <img src="./assets/Discord - Original.svg" alt="logo de discord">
                        <img src="./assets/Twitch - Original.svg" alt="logo de twitch">
                    </div>

                    <div class="register">
                        <p>Pas de compte ? <a href="inscription.php"><strong>Créer un compte</strong></a></p>
                    </div>
                </form>
            </div>
        </div>



    </section>
    <script src="burger.js"></script>
    <script src="passwordcheck.js"></script>
    <?php include_once("footer.php"); ?>