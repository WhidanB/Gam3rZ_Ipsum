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

        header("Location: backoffice.php");
    }
}


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
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="stylesheet" href="./fonts/stylesheet.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <section class="section1">
        <video autoplay loop muted>
            <source src="./assets/main.mp4">
        </video>





        <div class="form-box">
            <div class="form-value">
                <form class="connect" method="post">
                    <h2>Connexion</h2>
                    <div class="inputbox">
                        <svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <path d="m22 6-10 7L2 6"></path>
                        </svg>
                        <input type="email" name="user_mail" required />
                        <label for="user_mail">Adresse mail</label>
                    </div>
                    <div class="inputbox">
                        <svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input type="password" name="pass" required />
                        <label for="pass">Mot de passe</label>
                    </div>
                    <div class="forget">
                        <label for="">
                            <a href="#">Mot de passe oublié</a>
                        </label>
                    </div>
                    <input type="submit" value="Connexion" class="sub">
                    <div class="register">
                        <p>Vous n'avez pas de compte ? <a href="inscription.php">Créer un compte</a></p>
                    </div>
                </form>
            </div>
        </div>



    </section>


</body>

</html>