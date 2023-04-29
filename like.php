#!/usr/local/bin/php
<?php
	// Should update likes in database (not implemented yet...)


	//Database connection
	$conn = new mysqli("mysql.cise.ufl.edu", "dpayne1", "password", "Wagwan");
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$PostId = $_GET["PostId"];
	$Likes = $_GET["Likes"];

	// UPDATE LIKES IN DATABASE
	// $sql = "SELECT * FROM  WHERE  = ''";
	// $result = $conn->query($sql);
	

	// change like count of post
	$Likes = $Likes + 1;
	echo "&nbsp; " . $Likes ."";

	$conn->close();
	?>
