#!/usr/local/bin/php
<?php
	//Database connection
	$config = parse_ini_file("../db_config.ini"); // get credentials
	$conn = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$PostId = $_GET["PostId"];
	$UserId = $_GET["UserId"];
	$Rating = $_GET["Rating"];

	// insert or update rating table matching postid and userid
	$sql = "INSERT INTO dev_ratings (PostId, UserId, Rating) VALUES ($PostId, '$UserId', $Rating)
	ON DUPLICATE KEY UPDATE Rating = $Rating";
	
    if (mysqli_query($conn, $sql)) {
        echo "Record added successfully";
    } else {
        echo "Error adding record: " . mysqli_error($conn);
    }

	$conn->close();
?>
