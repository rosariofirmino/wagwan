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
	$Likes = $_GET["Likes"];

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
