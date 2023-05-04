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
	$Likes = $_GET["Likes"];

	// Check if like exists 
	$sql = "SELECT * FROM dev_likes WHERE PostId = '$PostId' AND UserId = '$UserId'";
	// check how many values are returned
	$result = $conn->query($sql);
 	// check rows in result
	$rows = $result->num_rows;
	if ($rows > 0) {
		echo "Already Liked";
		exit();
	}


	// UPDATE LIKES IN DATABASE
	$sql = "INSERT INTO dev_likes (UserId, PostId) VALUES ('$UserId', '$PostId')";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	  } else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	if(($Likes+1) % 10 == 0) {
		$sql = "SELECT Email from dev_posts INNER JOIN dev_users ON dev_posts.UserId = dev_users.UserId WHERE dev_posts.PostId = '$PostId'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$Email = $row['Email'];
		header("location: ../actions/sendEmailLike.php?email=" . $Email . "&likes=" . ($Likes+1));
	}
	$conn->close();
	?>
