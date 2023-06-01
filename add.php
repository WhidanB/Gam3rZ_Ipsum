<?php
session_start();

if ($_POST) {
    if (
        isset($_POST['game_name']) && isset($_POST['game_date']) && isset($_POST['game_desc']) && isset($_POST['cate_name']) && (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0)


    ) {         









                // we have the file
                // now -> file security
    // always verify file extension and Mime type
        //add any other type files Mime here, and also in /uploads/.htacess
        $allowed = [
            "jpg"  => "image/jpg",
            "jpeg" => "image/jpeg",
            "png"  => "image/png"            
        ];

        //recover filename
        $filename = $_FILES["image"]["name"];
        //recover type file
        $filetype = $_FILES["image"]["type"];
        //recover file size
        $filesize = $_FILES["image"]["size"];

        //recover extension file
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        // checking if extension / Mime is not correct
        if (!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)) {
            // extension or type is not correct
            die("file is not an image");
        }

        // file is correct

        // checking size 1mo
        if ($filesize > 1024 * 1024) {
            die("file too big");
        }

    // NOW create the uploads Folder and his .htaccess

        // generate unique name
        $newname = md5(uniqid());
        // generate path :  __DIR__ = recover path of this php file
        $newfilename = __DIR__ . "/uploads/$newname.$extension";

        //move file from temp folder -> ["tmp_name"] of image array, to upload folder ->  /uploads and rename it
        if(!move_uploaded_file($_FILES["image"]["tmp_name"], $newfilename)){
            die("upload failed");
        }      

        //644 to forbidden files from execution, can be changed for other permissions
        chmod($newfilename, 0644);















        print_r($_POST);
        require('connect.php');
        $game_name = strip_tags($_POST['game_name']);
        $game_date = $_POST['game_date'];
        $game_desc = strip_tags($_POST['game_desc']);
        $game_photo = $newfilename;
        $cate_name = $_POST['cate_name'];
        $added = DATE('Y/m/d');
        $user_name = $_SESSION["user"]["pseudo"];
        $sql = "INSERT INTO games (game_name, game_date, game_desc, game_photo, cate_name, added, user_name ) VALUES (:game_name, :game_date, :game_desc, :game_photo, :cate_name, :added, :user_name)";
        $query = $db->prepare($sql);
        $query->bindValue(':game_name', $game_name);
        $query->bindValue(':game_date', $game_date);
        $query->bindValue(':game_desc', $game_desc);
        $query->bindValue(':game_photo', $game_photo);
        $query->bindValue(':cate_name', $cate_name);
        $query->bindValue(':added', $added);
        $query->bindValue(':user_name', $user_name);
        var_dump($added);
        var_dump($user_name);
        $query->execute();
        require('close.php');
        header("Location: backoffice.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

    <main>


        <h1>Ajouter un jeu</h1>
        <form method="post">
            <div>
                <label for="game_name">Nom du jeu</label><input name="game_name" type="text">
                <label for="game_date">Date de sortie</label>
                <input type="date" name="game_date" required>
                <label for="game_desc">Description</label><input name="game_desc" type="text">

                <label for="fichier">Screenshot</label>           
                <input type="file" name="image" id="fichier" required>
               
                <div class="select">

                    <label for="cate_name">Catégorie</label>
                    <select name="cate_name" required>
                        <option value="RPG">RPG</option>
                        <option value="FPS">FPS</option>
                        <option value="MMO">MMO</option>
                        <option value="Strategie">Stratégie</option>
                        <option value="Simulation">Simulation</option>
                        <option value="Survival Horror">Survival Horror</option>

                    </select>


                </div>
                <input type="submit" value="Ajouter" class="sub">
        </form>
    </main>
</body>

</html>