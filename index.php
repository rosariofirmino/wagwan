#!/usr/local/bin/php
<html>

<head>
	<title>Wagwan Home Page</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./styles.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/your_code.js" crossorigin="anonymous"></script>
	<script src="js/functions.js"></script>
	<?php
		// Include Event class with php
		require_once('Event.php');

		// Include Event Object printer with php
		require_once("postprinter.php");
	?>

</head>

<body style="background-color: black; color: white;">
	<br>
	<h2 class="app-header"><strong>Top Wagwans</strong></h2>
	<a href="post.php" class="add-button"><i class="fas fa-plus"></i></a>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="Top Posts">
		<?php
		// reads from database
		$topPostsArray = array();

		$conn = new mysqli("mysql.cise.ufl.edu", "dpayne1", "password", "Wagwan");
		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM dev_posts";
		$result = $conn->query($sql);
		
		
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
		
			$Event = new Event($Title, $Description, $CategoryId, $Rating, $AgeRestrictions, $DateEvent, $Price, $Address, $UserId, $PostId);
			array_push($topPostsArray, $Event);
		}

		// Sort based on liked count
		usort($topPostsArray, 'compareLikes');

		$row = 0; // keeps track of row we are on
		
		for ($i = 0; $i < count($topPostsArray); $i++) {
			printEvent($topPostsArray[$i], $row);
		}
		?>
	</div>
	<br>
	<h2><strong>Wagwan Tonight</strong></h2>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="Tonight">
		<?php

		$row = $row + 1;
					
		for ($i = 0; $i < count($topPostsArray); $i++) {
			printEvent($topPostsArray[$i], $row);
		}
		?>
	</div>
	<br>
	<h2><strong>Wagwan this Weekend</strong></h2>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="Weekend">
		<?php

		$row = $row + 1;
					
		for ($i = 0; $i < count($topPostsArray); $i++) {
			printEvent($topPostsArray[$i], $row);
		}
		?>
	</div>
	<br>
	<h2><strong>Your liked Wagwans</strong></h2>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="Liked">
		<?php

		$row = $row + 1;
								
		for ($i = 0; $i < count($topPostsArray); $i++) {
			printEvent($topPostsArray[$i], $row);
		}
		?>
	</div>
</body>

</html>