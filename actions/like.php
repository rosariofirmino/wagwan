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

	// UPDATE LIKES IN DATABASE
	$sql = "INSERT INTO dev_likes (UserId, PostId) VALUES ('$UserId', '$PostId')";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	  } else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
	?>
