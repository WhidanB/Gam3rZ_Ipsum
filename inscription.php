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
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <section class="section1">
        <video autoplay loop muted>
            <source src="./assets/main.mp4">
        </video>



        
    <main>
        

            <div class="form-box">
                <div class="form-value">
                    <form class="connect" method="post">
                        <h2>Inscription</h2>
                        <div class="inputbox">
                            <svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <path d="M12 3a4 4 0 1 0 0 8 4 4 0 1 0 0-8z"></path>
                            </svg>
                            <input type="text" name="user_name" required />
                            <label for="user_name">Pseudo</label>
                        </div>
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
                        <input type="submit" value="S'inscrire" class="sub">
                        <div class="register">
                            <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>
                        </div>
                    </form>
                </div>
            </div>
        
    </main>

    </section>



</body>

</html>