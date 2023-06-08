<?php
session_start();

$_GET["id"];
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once("connect.php");

    $id = strip_tags($_GET['id']);
    $sql = "SELECT * FROM games WHERE game_id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();
    require_once('close.php');

    // header("Location: index.php");
}


if ($_POST) {
    if (
        isset($_POST['game_name']) && isset($_POST['game_date']) && isset($_POST['game_desc']) && isset($_POST['cate_name'])
    ) {

        $allowed = [
            "jpg"  => "image/jpg",
            "jpeg" => "image/jpeg",
            "png"  => "image/png"
        ];

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


        print_r($_POST);
        require('connect.php');
        $game_name = strip_tags($_POST['game_name']);
        $game_date = $_POST['game_date'];
        $game_desc = $_POST['game_desc'];
        $cate_name = $_POST['cate_name'];
        $sql = "UPDATE games SET game_name = :game_name, game_date = :game_date, game_desc = :game_desc, game_cover = :game_cover, cate_name = :cate_name WHERE game_id=$id";
        $query = $db->prepare($sql);
        $query->bindValue(':game_name', $game_name);
        $query->bindValue(':game_date', $game_date);
        $query->bindValue(':game_desc', $game_desc);
        $query->bindValue(':cate_name', $cate_name);
        $query->bindValue(':game_cover', $newfilename2);

        $query->execute();





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
    }
    require("close.php");
    header("Location: backoffice.php");
}
// else {
//     header("Location: index.php");
// }
$title = "Modifier" . " " . $result["game_name"];
include("headerAdd.php");
print_r($result["game_cover"]);
?>


<div class="container container-fluid d-flex justify-content-center align-items-center">
    <div class="col-8">
        <h1 class="text-center">Modifier un jeu</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="game_name">Nom du jeu</label><input name="game_name" value="<?= $result["game_name"] ?>" type="text" class="form-control" required>
                <label for="game_date">Date de sortie</label>
                <input type="date" name="game_date" value="<?= $result["game_date"] ?>" class="form-control" required>
                <label for="game_desc">Description</label><textarea name="game_desc" type="text" class="form-control" required><?= $result["game_desc"] ?></textarea>

                <div class="custom-file">
                    <input type="file" name="fileUpload[]" class="custom-file-input" id="chooseFile" multiple>
                    <label class="custom-file-label" for="chooseFile">Upload</label>
                </div>
                <div class="container imgGallery">
                    <!-- image preview -->
                </div>

                <div class="form-group">
                    <label for="jaquette">Jaquette</label>
                    <input type="file" name="image" id="jaquette" value="<?= $result["game_cover"] ?>" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="cate_name">Catégorie</label>
                    <select name="cate_name" value="<?= $result["cate_name"] ?>" required>
                        <option value="RPG">RPG</option>
                        <option value="FPS">FPS</option>
                        <option value="MMO">MMO</option>
                        <option value="Strategie">Stratégie</option>
                        <option value="Simulation">Simulation</option>
                        <option value="Survival Horror">Survival Horror</option>

                    </select>
                </div>
            </div>

            <input type="submit" value="Modifier" class="sub">
        </form>
    </div>
</div>
</main>

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