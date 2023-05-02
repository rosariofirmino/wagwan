#!/usr/local/bin/php
<?php
$config = parse_ini_file("../db_config.ini");

$link = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_SESSION["id"];
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);
    $profile_picture = $_FILES["profile_picture"]["name"];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profile_picture"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["profile_picture"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    if (!empty($email)) {
        $sql = "UPDATE dev_users SET Email = ? WHERE UserId = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $email, $userid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    if (!empty($password) && !empty($confirm_password) && ($password == $confirm_password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE dev_users SET Password = ? WHERE UserId = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $userid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    //   if (!empty($profile_picture)) {
//     $sql = "UPDATE dev_users SET ProfilePicture = ? WHERE UserId = ?";
//     if($stmt = mysqli_prepare($link,

}
mysqli_close($link);
header("Location: ../index.php");
exit();
?>