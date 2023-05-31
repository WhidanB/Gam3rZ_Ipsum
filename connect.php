<?php
try {
    $server_name = "localhost";
    $db_name = "escromania";
    $username = "root";
    $password = "";
    $db = new PDO("mysql:host=$server_name;dbname=$db_name; charset=utf8mb4", $username, $password);
    // echo 'Connexion réussie 👍🏻';
} catch (PDOException $e) {
    echo "Echec de connexion : " . $e->getMessage();
}
