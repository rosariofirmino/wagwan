#!/usr/local/bin/php

<?php
require_once('../Event.php');
require_once('../postprinter.php');

$type = $_GET["type"];

if($type == "suggest_near") {
    suggest_near();
}

function suggest_near() {
    $config = parse_ini_file("../db_config.ini");

    $link = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
    $link->set_charset('utf8mb4');
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }
    
    $q = $_GET["loc"];
    $sql = "SELECT * FROM dev_posts WHERE Address LIKE ?";
        
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_location);
        $param_location = '%' . $q . '%';
        
        if(mysqli_stmt_execute($stmt)){
            $result = $stmt->get_result();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    while($row = $result->fetch_assoc())
    {	
        $PostId = $row["PostId"];
        $UserId = htmlspecialchars($row["UserId"]);
        $Address = htmlspecialchars($row["Address"], ENT_QUOTES);
        $Title = htmlspecialchars($row["Title"], ENT_QUOTES);
        $Description = htmlspecialchars($row["Description"], ENT_QUOTES);
        $Price = $row["Price"];
        $CategoryId = htmlspecialchars($row["CategoryId"], ENT_QUOTES);
        $AgeRestrictions = htmlspecialchars($row["AgeRestrictions"], ENT_QUOTES);
        $Rating = $row["Rating"];
        $DateEvent = htmlspecialchars($row["DateEvent"], ENT_QUOTES);
        $ImageId = htmlspecialchars($row["ImageId"]);

        $Event = new Event($Title, $Description, $CategoryId, $Rating, $AgeRestrictions, $DateEvent, $Price, $Address, $UserId, $PostId, $ImageId);
        printEvent($Event, 1);
    }

    mysqli_stmt_close($stmt);
}
?>