<?php
session_start();

include_once '../config/database.php';
include_once '../objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$user->pic = "true";

function redirect() {
    ob_start();
    header('Location: ./profile.php');
    ob_end_flush();
    die();
}

define("UPLOAD_DIR", "/test/images/profilePics/");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $file = $_FILES["photo"];

        $filename = $_SESSION['userName'].".jpg";

        $_SESSION['picName'] = $filename;
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];


        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        if (in_array($filetype, $allowed)) {
            move_uploaded_file($file["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . UPLOAD_DIR . $filename); $picSet = 1 or
            die("Unable to save file.");
        }
        else {
            $picSet = 0;
        }

        if($picSet==1 && $user->picSet()){
            redirect();
        }
        else{
            echo "Unable to save file.";
        }
    }
}
?>

<body>
<form action="fileUpload.php" method="post" enctype="multipart/form-data">
    <h2>Upload File</h2>
    <label for="fileSelect">Filename:</label>
    <input type="file" name="photo" id="fileSelect">
    <input type="submit" name="submit" value="Upload">
    <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB.</p>
</form>
</body>
</html>