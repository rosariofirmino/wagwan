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
	<title>Your Posted Wagwans</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./styles.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script src="js/functions.js"></script>
	<?php
	// Include Event class with php
	require_once('Event.php');

	// Include Event Object printer with php
	require_once("postprinter.php");

	if (isset($_GET['UserId'])) {
		$userId = $_GET['UserId'];
	}

	?>
</head>

<body style="background-color: black; color: white;">
	<div id="root"></div>
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
							<a href="userprofile.php?UserId=<?php echo ($isLoggedIn === true) ? $id : "" ?>">
								<img src="./profile_pictures/<?php echo (isset($_SESSION["ProfilePic"])) ? $_SESSION["ProfilePic"] : "default.jpg"; ?>"
									width="40" alt="profile picture" class="rounded-circle ms-2"
									style="width: 40px; height: 40px; margin-left: 10px;">
							</a>
						<?php } ?>
					</li>

				</ul>
			</div>
		</div>
	</nav>
	<br>
	<h2 class="app-header"><strong>
			<?php echo $userId; ?>'s Wagwans
		</strong></h2>
	<a href="post.php" class="add-button"><i class="fas fa-plus"></i></a>
	<div class="d-flex flex-row flex-nowrap overflow-auto" id="UserPosts0">
		<?php
		// reads from database
		$userPostsArray = array();

		$conn = new mysqli("mysql.cise.ufl.edu", "dpayne1", "password", "Wagwan");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// get user's posts from posts table
		$sql = "SELECT * FROM dev_posts WHERE UserId = '$userId'";
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

			$Event = new Event($Title, $Description, $CategoryId, $Rating, $AgeRestrictions, $DateEvent, $Price, $Address, $UserId, $PostId, $ImageId);
			array_push($userPostsArray, $Event);
		}

		// reverse array so most recent posts are first
		$userPostsArray = array_reverse($userPostsArray);

		$row = 0; // keeps track of row we are on
		
		for ($i = 0; $i < count($userPostsArray); $i++) {
			// print each event object
			printEventMadeByUser($userPostsArray[$i], $row);

			//layout for cards: 3 cards per row
			if (($i + 1) % 3 == 0) { // start a new div after every 3rd card
				echo "</div><br>";
				echo "<div class='d-flex flex-row flex-nowrap overflow-auto' id='UserPosts" . $i . "'>";
				$row++;
			}
		}
		?>
	</div>
	<br>
</body>

</html>