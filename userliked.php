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
}
else {
	echo "<!DOCTYPE html>\n";
	echo "<html lang='en'>\n";
	echo "<head>\n";
	echo "<script>var id = '';</script>\n";
	echo "<script>var isLoggedIn = false;</script>\n";
}
$config = parse_ini_file("./db_config.ini");
$UserId = $_SESSION["id"];
?>
	<title>Your Liked Wagwans</title>
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./styles.css">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;900&display=swap" rel="stylesheet">
	
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;900&display=swap" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>

	<script src="js/functions.js"></script>
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
			<a class="navbar-brand" href="index.php"><img src="homepage/hp/wagwan.png" style='width: 35px;' alt=""></a> <button
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
				class="navbar-toggler" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse"
				type="button"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a style="color: #D1D7E0;" class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a style="color: #D1D7E0;" class="nav-link" href="search.php">Search</a>
					</li>
					<li class="nav-item">
						<a style="color: #D1D7E0;" class="nav-link" href="userliked.php">Likes</a>
					</li>
					<li class="nav-item">
						<a style="color: #D1D7E0;" class="nav-link"
							href="userprofile.php?UserId=<?php echo ($isLoggedIn === true) ? $id : "" ?>"><?php echo
									 	($isLoggedIn === true) ? $id : "Log In" ?></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<br>
	<h2 class="app-header"><strong>Your Liked Wagwans</strong></h2>
	<a href="post.php" class="add-button"><i class="fas fa-plus"></i></a>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="LikedWagwans">
		<?php
		// reads from database
		$likedPostsArray = array();

		$servername = $config["servername"];
		$username = $config["username"];
		$password = $config["password"];
		$dbname = $config["dbname"];
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// get liked posts from likes table
		$sql = "SELECT * FROM dev_likes WHERE UserId = '$UserId'";
		$result = $conn->query($sql);


		while ($row = $result->fetch_assoc()) {
			$PostId = $row["PostId"];
			$sql = "SELECT * FROM dev_posts WHERE PostId = '$PostId'";
			$resultPosts = $conn->query($sql);

			$row = $resultPosts->fetch_assoc();

			$PostId = $row["PostId"];
			$UserId = htmlspecialchars($row["UserId"]);
			$Address = htmlspecialchars($row["Address"], ENT_QUOTES);
			$Title = htmlspecialchars($row["Title"], ENT_QUOTES);
			$Description = htmlspecialchars($row["Description"], ENT_QUOTES);
			$Price = $row["Price"];
			$CategoryId = htmlspecialchars($row["CategoryId"], ENT_QUOTES);
			$AgeRestrictions = htmlspecialchars($row["AgeRestrictions"], ENT_QUOTES);
			$DateEvent = htmlspecialchars($row["DateEvent"], ENT_QUOTES);
			$Rating = $row["Rating"];
			$ImageId = htmlspecialchars($row["ImageId"]);
			$DateCreated = htmlspecialchars($row["DateCreated"], ENT_QUOTES);

			$Event = new Event($Title, $Description, $CategoryId, $Rating, $AgeRestrictions, $DateEvent, $Price, $Address, $UserId, $PostId, $ImageId);
			$Event->setDateCreated($DateCreated);
			$Event->setSessionId($id);
			$Event->checkIfLiked($PostId);
			array_push($likedPostsArray, $Event);
		}

		// reverse array so most recent posts are first
		$likedPostsArray = array_reverse($likedPostsArray);

		$row = 0; // keeps track of row we are on
		
		for ($i = 0; $i < count($likedPostsArray); $i++) {
			printEvent($likedPostsArray[$i], $row);

			//layout for cards: 3 cards per row
			if (($i + 1) % 3 == 0) { // start a new div after every 3rd card
				echo "</div><br>";
				echo "<div class='d-flex flex-row flex-nowrap overflow-auto' id='Top Posts" . $i . "'>";
				$row++;
			}
		}
		?>
	</div>
	<br>
</body>

</html>