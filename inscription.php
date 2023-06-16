<?php

session_start();

if (isset($_SESSION["user"])) {
    header("Location: index.php");
}

if (!empty($_POST)) {
    if (isset($_POST["user_name"], $_POST["user_mail"], $_POST["pass"]) && !empty($_POST["user_name"]) && !empty($_POST["user_mail"]) && !empty($_POST["pass"])) {

        $pseudo = strip_tags($_POST["user_name"]);
        if (!filter_var($_POST["user_mail"], FILTER_VALIDATE_EMAIL)) {
            die("L'adresse mail est incorrecte");
        }

        $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);

        require_once("connect.php");

        $sql = "INSERT INTO users (user_name, user_mail, pass) VALUES (:user_name, :user_mail, '$pass')";
        $query = $db->prepare($sql);
        $query->bindValue(":user_name", $pseudo);
        $query->bindValue(":user_mail", $_POST["user_mail"]);
        $query->execute();

        $id = $db->lastInsertId();
        $role = "user";



        $_SESSION["user"] = [
            "id" => $id,
            "pseudo" => $pseudo,
            "email" => $_POST["user_mail"],
            "role" => $role
        ];

        header("Location: index.php");
    } else {
        die("Le formulaire n'est pas complet");
    }
}

$title = "Register";


include "navbar.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="./fonts/stylesheet.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="media.css">
</head>

<body>
    <section class="section1">
        <video class="video2"autoplay loop muted>
            <source src="./assets/main.mp4">
        </video>
        <div class="form-box">
            <div class="form-value">
                <form class="connect" method="post">
                    <h2>Création de compte</h2>
                    <div class="inputbox">
                        <label for="user_name">Nom d'utilisateur</label><br>
                        <input type="text" name="user_name" required />
                    </div>
                    <div class="inputbox">
                        <label for="user_mail">E-mail</label><br>
                        <input type="email" name="user_mail" required />
                    </div>
                    <div class="inputbox">
                        <label for="pass">Mot de passe</label><br>
                        <input type="password" id="input" name="pass" required />
                        <p id="warning"></p>
                    </div>
                    <input type="submit" value="S'inscrire" class="sub">

                    <div class="formlogo">
                        <img src="./assets/Facebook - Original.svg" alt="logo de facebook">
                        <img src="./assets/Discord - Original.svg" alt="logo de discord">
                        <img src="./assets/Twitch - Original.svg" alt="logo de twitch">
                    </div>

                    <div class="register">
                        <p>Vous avez déjà un compte ? <a href="login.php"><strong>Connexion</strong></a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <footer>
        <div class="footer-left">
            <a href="index.php">G@m3rZ Ipsum</a>
            <p>copyright by G@m3rzIpsum</p>
        </div>
        <div class="footer-center">
            <ul>
                <li><a href="">Jeux</a></li>
                <li><a href="">À propos</a></li>
                <li><a href="">Contact</a></li>
            </ul>
        </div>
        <div class="footer-right">
            <p>ACS Nevers</p>
            <a href="mailto:lechef@jadoo.fr">lechef@jadoo.fr</a>
            <div class="icons">
                <img src="./assets/Facebook - Original.svg" alt="logo de facebook">
                <img src="./assets/YouTube - Original.svg" alt="logo de youtube">
                <img src="./assets/Discord - Original.svg" alt="logo de discord">
                <img src="./assets/Twitch - Original.svg" alt="logo de twitch">
            </div>
        </div>
    </footer>
    <script src="passwordcheck.js"></script>
    <script src="burger.js"></script>
</body>

</html>