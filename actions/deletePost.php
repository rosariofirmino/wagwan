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

	// First, delete all likes associated with this post in dev_likes
	$sql = "DELETE FROM dev_likes WHERE PostId=$PostId";
	if ($conn->query($sql) === TRUE) {
		echo "Delete successfully completed";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	// Second, delete post in dev_posts
	$sql = "DELETE FROM dev_posts WHERE UserId='$UserId' AND PostId=$PostId";
	if ($conn->query($sql) === TRUE) {
		echo "Delete successfully completed";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>
