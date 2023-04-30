#!/usr/local/bin/php
<?php
	//Database connection
	$conn = new mysqli("mysql.cise.ufl.edu", "dpayne1", "password", "Wagwan");
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$PostId = $_GET["PostId"];
	$UserId = $_GET["UserId"];

	// DELETE POST IN DATABASE
	$sql = "DELETE FROM dev_posts WHERE UserId='$UserId' AND PostId='$PostId'";
	if ($conn->query($sql) === TRUE) {
		echo "New deleted successfully";
	  } else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	?>
