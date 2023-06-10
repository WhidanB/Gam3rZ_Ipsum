<?php
session_start();

if ($_POST) {
    if (
        isset($_POST['game_name']) && isset($_POST['game_date']) && isset($_POST['game_desc']) && isset($_POST['cate_name']) && isset($_FILES["image"])
    ) {
        require('connect.php');
        //echo "<pre>";
        //var_dump($_FILES);
        //echo "</pre>";

        // file screenshot process
        // $file1 = $_FILES["image"]["tmp_name"][0];
        // $filename1 = $_FILES["image"]["name"][0];
        // $filetype1 = $_FILES["image"]["type"][0];
        // $filesize1 = $_FILES["image"]["size"][0];
        // $extension1 = strtolower(pathinfo($filename1, PATHINFO_EXTENSION));



        // if (!array_key_exists($extension1, $allowed) || !in_array($filetype1, $allowed) || $filesize1 > 2048 * 2048) {
        //     die("Screenshot file problem");
        // }

        // $newname1 = md5(uniqid()) . "." . $extension1;
        // $newfilename1 = "./uploads/$newname1";

        // if (!move_uploaded_file($file1, $newfilename1)) {
        //     die("Failed to upload Screenshot file");
        // }
        // END file screenshot process
        $allowed = [
            "jpg"  => "image/jpg",
            "jpeg" => "image/jpeg",
            "png"  => "image/png"
        ];
        $uploadsDir = "uploads/";
        $allowedFileType = array('jpg', 'png', 'jpeg');
        foreach ($_FILES['fileUpload']['name'] as $id => $val) {
            // Get files upload path
            $fileName        = $_FILES['fileUpload']['name'][$id];
            $tempLocation    = $_FILES['fileUpload']['tmp_name'][$id];
            $game = $_POST['game_name'];
            $targetFilePath  = $uploadsDir . $fileName;
            $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $uploadDate      = date('Y-m-d H:i:s');
            $uploadOk = 1;
            if (in_array($fileType, $allowedFileType)) {
                if (move_uploaded_file($tempLocation, $targetFilePath)) {
                    $sqlVal = "('" . $targetFilePath . "', '" . $uploadDate . "', '" . $game . "')";
                } else {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "File coud not be uploaded."
                    );
                }
            }
            if (!empty($sqlVal)) {
                $insert = $db->query("INSERT INTO screenshots (images, date_time, game) VALUES $sqlVal");
                if ($insert) {
                    $response = array(
                        "status" => "alert-success",
                        "message" => "Files successfully uploaded."
                    );
                } else {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "Files coudn't be uploaded due to database error."
                    );
                }
            }
        }

        // file jaquette process
        $file2 = $_FILES["image"]["tmp_name"];
        $filename2 = $_FILES["image"]["name"];
        $filetype2 = $_FILES["image"]["type"];
        $filesize2 = $_FILES["image"]["size"];
        $extension2 = strtolower(pathinfo($filename2, PATHINFO_EXTENSION));

        if (!array_key_exists($extension2, $allowed) || !in_array($filetype2, $allowed) || $filesize2 > 4096 * 4096) {
            die("Jaquette file problem");
        }

        $newname2 = md5(uniqid()) . "." . $extension2;
        $newfilename2 = "./uploads/$newname2";

        if (!move_uploaded_file($file2, $newfilename2)) {
            die("Failed to upload Jaquette file");
        }
        //END file jaquette process

        //adding to db        

        $game_name = strip_tags($_POST['game_name']);
        $game_date = $_POST['game_date'];
        $game_desc = strip_tags($_POST['game_desc']);
        $game_cover = $newfilename2;
        $cate_name = $_POST['cate_name'];
        $added = DATE('Y/m/d');
        $user_name = $_SESSION["user"]["pseudo"];
        $sql = "INSERT INTO games (game_name, game_date, game_desc, game_cover, cate_name, added, user_name ) VALUES (:game_name, :game_date, :game_desc, :game_cover, :cate_name, :added, :user_name)";
        $query = $db->prepare($sql);
        $query->bindValue(':game_name', $game_name);
        $query->bindValue(':game_date', $game_date);
        $query->bindValue(':game_desc', $game_desc);
        $query->bindValue(':game_cover', $game_cover);
        $query->bindValue(':cate_name', $cate_name);
        $query->bindValue(':added', $added);
        $query->bindValue(':user_name', $user_name);
        $query->execute();
        require('close.php');
        $_SESSION["add"]["toast"] = 1;
        header("Location: backoffice.php");
    }
}


$title = "Add a game";
include "headerAdd.php";

?>

<div class="container container-fluid d-flex justify-content-center align-items-center">
    <div class="col-8">
        <h1 class="text-center">Ajouter un jeu</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="game_name">Nom du jeu</label>
                <input name="game_name" type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="game_date">Date de sortie</label>
                <input type="date" name="game_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="game_desc">Description</label>
                <textarea name="game_desc" class="form-control" required></textarea>
            </div>





            <!-- Screenshot mulitple -->

            <div class="custom-file">
                <input type="file" name="fileUpload[]" class="custom-file-input" id="chooseFile" multiple>
                <label class="custom-file-label" for="chooseFile">Upload</label>
            </div>
            <div class="container imgGallery">
                <!-- image preview -->
            </div>

            <!-- End Screenshot mulitple -->




            <!-- <div class="form-group">
                <label for="screenshot">Screenshot</label>
                <input type="file" name="image[]" id="screenshot" class="form-control-file" required>
            </div> -->
            <div class="form-group">
                <label for="jaquette">Jaquette</label>
                <input type="file" name="image" id="jaquette" class="form-control-file" required>
            </div>
            <div class="form-group">
                <label for="cate_name">Catégorie</label>
                <select name="cate_name" class="form-control" required>
                    <option value="RPG">RPG</option>
                    <option value="FPS">FPS</option>
                    <option value="MMO">MMO</option>
                    <option value="Strategie">Stratégie</option>
                    <option value="Simulation">Simulation</option>
                    <option value="Survival Horror">Survival Horror</option>
                </select>
            </div>
            <div class="text-center">
                <input type="submit" value="Ajouter un Jeu" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<!-- Script et jquery pour les preview du multiple screenshot -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(function() {
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#chooseFile').on('change', function() {
            multiImgPreview(this, 'div.imgGallery');
        });
    });
</script>
<!-- END Script -->