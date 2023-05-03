#!/usr/local/bin/php
<?php
session_start();
$isLoggedIn = false;
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
	$isLoggedIn = true;
	$id = $_SESSION["id"];
	echo "<!DOCTYPE html>\n";
	echo "<html lang='en'>\n";
	echo "<head>\n";
	echo "<script>var id = '$id';</script>\n";
	echo "<script>var isLoggedIn = true;</script>\n";
} else {
	echo "<!DOCTYPE html>\n";
	echo "<html lang='en'>\n";
	echo "<head>\n";
	echo "<script>var id = '';</script>\n";
	echo "<script>var isLoggedIn = false;</script>\n";
}
?>
<title>Wagwan Home Page</title>
<link rel="icon" href="homepage/hp/icon.png">
<link rel="stylesheet" href="./styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;900&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="js/functions.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js">
</script>
<?php
// Include Event class with php
require_once('Event.php');

// Include Event Object printer with php
require_once("postprinter.php");
?>

</head>

<body style="background-color: #2D283E ; color:#D1D7E0 ;">
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #2D283E ;">
		<div class="container">
			<a class="navbar-brand" href="index.php"><img src="homepage/hp/wagwan.png" width="35" alt="logo"></a>
			<button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
				class="navbar-toggler" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse"
				type="button"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a style="color: #D1D7E0;" class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a style="color: #D1D7E0;" class="nav-link" href="#">Search</a>
					</li>
					<li class="nav-item">
						<a style="color: #D1D7E0;" class="nav-link" <?php echo ($isLoggedIn === true) ? "href='userliked.php'>Likes</a>" : "href='php/login.php'>Likes</a>" ?> </li>
					<li class="nav-item">
						<a style="color: #D1D7E0;" class="nav-link"
							href="userprofile.php?UserId=<?php echo ($isLoggedIn === true) ? $id : "" ?>"><?php echo
									 	($isLoggedIn === true) ? $id : "Log In" ?></a>
					</li>
					<li class="nav-item">
						<?php if ($isLoggedIn === true) { ?>
							<a href="userprofile.php?UserId=<?php echo ($isLoggedIn === true) ? $id : "" ?>"><img
									src="./profile_pictures/<?php echo ($_SESSION["ProfilePic"] != null) ? $_SESSION["ProfilePic"] : "default.jpg"; ?>"
									width="40" alt="profile picture" class="rounded-circle ms-2"
									style="width: 40px; height: 40px; margin-left: 10px;">
							</a>
						<?php } ?>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="carousel slide" data-bs-ride="carousel" id="carouselExampleIndicators">
		<div class="carousel-indicators">
			<button aria-label="Slide 1" class="active" data-bs-slide-to="0" data-bs-target="#carouselExampleIndicators"
				type="button"></button> <button aria-label="Slide 2" data-bs-slide-to="1"
				data-bs-target="#carouselExampleIndicators" type="button"></button> <button aria-label="Slide 3"
				data-bs-slide-to="2" data-bs-target="#carouselExampleIndicators" type="button"></button>
		</div>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img alt="..." class="d-block w-100" src="homepage/hp/gv2.jpeg">
			</div>
			<div class="carousel-item">
				<img alt="..." class="d-block w-100" src="homepage/hp/gv1.jpeg">
			</div>
			<div class="carousel-item">
				<img alt="..." class="d-block w-100" src="homepage/hp/gv3.jpeg">
			</div>
			<div class="centered">
				<h5 class="titletext">Wagwan Near Me</h5>
				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="Enter Location"
						aria-describedby="basic-addon2">
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="button">Search</button>
					</div>
				</div>
			</div>
		</div><button class="carousel-control-prev" data-bs-slide="prev" data-bs-target="#carouselExampleIndicators"
			type="button"><span aria-hidden="true" class="carousel-control-prev-icon"></span> </button> <button
			class="carousel-control-next" data-bs-slide="next" data-bs-target="#carouselExampleIndicators"
			type="button"><span aria-hidden="true" class="carousel-control-next-icon"></span> </button>
	</div>
	<br>
	<h2 class="app-header"><strong>Top Wagwans</strong></h2>
	<a href="post.php" class="add-button"><i class="fas fa-plus"></i></a>
	<div class="d-flex flex-row" id="TopWagwans" style="flex-wrap: nowrap; overflow-x:auto; overflow-y: hidden;">
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

		while ($row = $result->fetch_assoc()) {
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
			$DateCreated = htmlspecialchars($row["DateCreated"], ENT_QUOTES);

			$Event = new Event($Title, $Description, $CategoryId, $Rating, $AgeRestrictions, $DateEvent, $Price, $Address, $UserId, $PostId, $ImageId);
			$Event->setDateCreated($DateCreated);
			$Event->setSessionId($id);
			$Event->checkIfLiked($PostId);
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
	<h2 class="app-header"><strong>Wagwans Happening Soon</strong></h2>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="Tonight">
		<?php

		$postsArr = $topPostsArray;

		usort($postsArr, 'compareDateEvent');
		$postsArr = removeIfDatePassed($topPostsArray);
		$postsArr = removeIfDateFar($postsArr, 7); // remove if date is more than 7 days away
		
		$row = $row + 1;

		foreach ($postsArr as $key => $value) {
			printEvent($value, $row);
		}

		// if empty, print no events happening soon
		if (empty($postsArr)) {
			echo "</div><h2 class='app-header' style='text-align: center;'>No wagwans happening soon</h2><div>";
		}
		?>
	</div>
	<br>
	<h2 class="app-header"><strong>Highest Rated Wagwans (all time)</strong></h2>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="Weekend">
		<?php
		$postsArr = $topPostsArray;
		usort($postsArr, 'compareRating');
		$postsArr = removeIfRatingLow($postsArr, 4); // remove if rating is less than 4
		
		$row = $row + 1;

		foreach ($postsArr as $key => $value) {
			printEvent($value, $row);
		}
		if (empty($postsArr)) {
			echo "</div><h2 class='app-header' style='text-align: center;'>No wagwans rated 4 or 5 stars</h2><div>";
		}
		?>
	</div>
	<br>
	<h2 class="app-header"><strong>Top Free Wagwans 🆓</strong></h2>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="Weekend">
		<?php
		$postsArr = $topPostsArray;
		$postsArr = removeIfDatePassed($topPostsArray);
		$postsArr = keepXPriceOnly($postsArr, 0); // keep if price is 0
		
		$row = $row + 1;

		foreach ($postsArr as $key => $value) {
			printEvent($value, $row);
		}
		if (empty($postsArr)) {
			echo "</div><h2 class='app-header' style='text-align: center;'>No free wagwans are coming up soon...</h2><div>";
		}
		?>
	</div>
	<br>
	<h2 class="app-header"><strong>Top Cheap Wagwans 💸</strong></h2>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="Weekend">
		<?php
		$postsArr = $topPostsArray;
		$postsArr = removeIfDatePassed($topPostsArray);
		$postsArr = keepXPriceOnly($postsArr, 1); // keep if price is 1
		
		$row = $row + 1;

		foreach ($postsArr as $key => $value) {
			printEvent($value, $row);
		}
		if (empty($postsArr)) {
			echo "</div><h2 class='app-header' style='text-align: center;'>No cheap wagwans are coming up soon...</h2><div>";
		}
		?>
	</div>
	<br>
	<h2 class="app-header"><strong>Top Affordable Wagwans 💰</strong></h2>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="Weekend">
		<?php
		$postsArr = $topPostsArray;
		$postsArr = removeIfDatePassed($topPostsArray);
		$postsArr = keepXPriceOnly($postsArr, 2); // keep if price is 2
		
		$row = $row + 1;

		foreach ($postsArr as $key => $value) {
			printEvent($value, $row);
		}
		if (empty($postsArr)) {
			echo "</div><h2 class='app-header' style='text-align: center;'>No affordable wagwans are coming up soon...</h2><div>";
		}
		?>
	</div>
	<br>
	<h2 class="app-header"><strong>Top Expensive Wagwans 💎</strong></h2>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="Weekend">
		<?php
		$postsArr = $topPostsArray;
		$postsArr = removeIfDatePassed($topPostsArray);
		$postsArr = keepXPriceOnly($postsArr, 3); // keep if price is 3
		
		$row = $row + 1;

		foreach ($postsArr as $key => $value) {
			printEvent($value, $row);
		}
		if (empty($postsArr)) {
			echo "</div><h2 class='app-header' style='text-align: center;'>No expensive wagwans are coming up soon...</h2><div>";
		}
		?>
	</div>
	<br>
	<h2 class="app-header"><strong>Newest Posted Wagwans</strong></h2>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="Weekend">
		<?php
		$postsArr = $topPostsArray;
		$postsArr = removeIfDatePassed($topPostsArray);
		usort($postsArr, 'compareDateCreated');

		$row = $row + 1;

		foreach ($postsArr as $key => $value) {
			printEvent($value, $row);
		}
		if (empty($postsArr)) {
			echo "</div><h2 class='app-header' style='text-align: center;'>No wagwans have been posted recently...</h2><div>";
		}
		?>
	</div>
	<br>
	<h2 class="app-header"><strong>Wagwans for All Ages</strong></h2>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="Weekend">
		<?php
		$postsArr = $topPostsArray;
		$postsArr = removeIfDatePassed($topPostsArray);
		$postsArr = keepAgeGroupOnly($postsArr, 'All Ages');

		$row = $row + 1;

		foreach ($postsArr as $key => $value) {
			printEvent($value, $row);
		}
		if (empty($postsArr)) {
			echo "</div><h2 class='app-header' style='text-align: center;'>No Wagwans for All Ages have been posted recently...</h2><div>";
		}
		?>
	</div>
	<br>
	<h2 class="app-header"><strong>Wagwans 18 and Up</strong></h2>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="Weekend">
		<?php
		$postsArr = $topPostsArray;
		$postsArr = removeIfDatePassed($topPostsArray);
		$postsArr = keepAgeGroupOnly($postsArr, '18+');

		$row = $row + 1;

		foreach ($postsArr as $key => $value) {
			printEvent($value, $row);
		}
		if (empty($postsArr)) {
			echo "</div><h2 class='app-header' style='text-align: center;'>No Wagwans for 18+ have been posted recently...</h2><div>";
		}
		?>
	</div>
	<br>
	<h2 class="app-header"><strong>Wagwans 21 and Up</strong></h2>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="Weekend">
		<?php
		$postsArr = $topPostsArray;
		$postsArr = removeIfDatePassed($topPostsArray);
		$postsArr = keepAgeGroupOnly($postsArr, '21+');

		$row = $row + 1;

		foreach ($postsArr as $key => $value) {
			printEvent($value, $row);
		}
		if (empty($postsArr)) {
			echo "</div><h2 class='app-header' style='text-align: center;'>No Wagwans for 21+ have been posted recently...</h2><div>";
		}
		?>
	</div>
	<br>
	<h2 class="app-header"><strong>Your liked Wagwans</strong></h2>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="Liked">
		<?php
		$postsArr = keepLiked($topPostsArray);
		$row = $row + 1;

		foreach ($postsArr as $key => $value) {
			printEvent($value, $row);
		}
		if (empty($postsArr)) {
			echo "</div><h2 class='app-header' style='text-align: center;'>You haven't liked any Wagwans yet!</h2><div>";
		}
		?>
	</div>
</body>

</html>