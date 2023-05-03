#!/usr/local/bin/php
<?php
session_start();
$isLoggedIn = true;
// Check if the user is already logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: ./php/login.php");
	$isLoggedIn = false;
	exit;
}
$config = parse_ini_file("./db_config.ini");
$UserId = $_SESSION["id"];

?>
<link rel="stylesheet" href="./styles.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/your_code.js" crossorigin="anonymous"></script>

<script>
	var activeTab = "account-management";
	var oldTab = "manage-wagwans";

	function openTab(tabName) {
		oldTab = activeTab;
		activeTab = tabName;

		document.getElementById(oldTab).style.display = "none";
		document.getElementById(activeTab).style.display = "block";

		document.getElementById(oldTab + "-link").classList.remove("active");
		document.getElementById(activeTab + "-link").classList.add("active");
	}

</script>

<?php
// Include Event class with php
require_once('Event.php');

// Include Event Object printer with php
require_once("postprinter.php");
?>
<html>



<head>
	<style>
		.list-group-item.active {
			background-color: #007bff;
			color: #fff;
		}

		.user-profile {
			background-color: #1c1c1c;
			color: #f5f5f5;
		}

		.user-profile .card-header {
			background-color: #343a40;
			border-bottom: none;
		}

		.user-profile h3 {
			color: #f5f5f5;
		}

		.user-profile label {
			color: #f5f5f5;
		}

		.user-profile input[type="text"],
		.user-profile input[type="email"],
		.user-profile input[type="password"] {
			background-color: #2c2c2c;
			color: #f5f5f5;
			border-color: #f5f5f5;
		}

		.user-profile .form-control-file {
			color: #f5f5f5;
		}

		.user-profile button[type="submit"] {
			background-color: #007bff;
			color: #f5f5f5;
			border-color: #007bff;
		}

		.user-profile button[type="submit"]:hover {
			background-color: #0069d9;
			border-color: #0062cc;
		}

		.user-profile input[disabled] {
			color: #aaa;
			font-style: italic;
		}
	</style>

	<?php
	echo "<title>$UserId's Profile</title>";
	?>
</head>

<script>
	function likeButtonPress(Row, PostId, Likes, UserLiked) {

		if (UserLiked == true) { // unlike
			// set icon to unlike
			$("#" + Row + "path" + PostId).attr("d", "m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z");

			// set like count to likes - 1
			$("#" + Row + "likes" + PostId).html("&nbsp; " + (Likes - 1) + "");

			// change button onclick
			$("#button" + Row + "" + PostId).attr("onClick", "likeButtonPress(" + Row + ", " + PostId + ", " + (Likes - 1) + ", " + !UserLiked + ")");
		}
		else { // like
			// set icon to like4
			$("#" + Row + "path" + PostId).attr("d", "M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z");

			// set like count to likes - 1
			$("#" + Row + "likes" + PostId).html("&nbsp; " + (Likes + 1) + "");

			// change button onclick
			$("#button" + Row + "" + PostId).attr("onClick", "likeButtonPress(" + Row + ", " + PostId + ", " + (Likes + 1) + ", " + !UserLiked + ")");
		}


		// AJAX for like update / update like in database

		// get UserId
		var UserId = "admin"; // TODO: get UserId from session

		const xhttp = new XMLHttpRequest();

		if (UserLiked == true) { // unlike
			xhttp.open("GET", "actions/dislike.php?PostId=" + PostId + "&UserId=" + UserId, true);
		}
		if (UserLiked == false) { // like
			xhttp.open("GET", "actions/like.php?PostId=" + PostId + "&UserId=" + UserId, true);
		}

		xhttp.send();
	}
</script>

<body style="background-color: black; color: white;"
	onload=" openTab('manage-wagwans'); openTab('account-management');">
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #2D283E ;">
		<div class="container">
			<a class="navbar-brand" href="index.php"><img src="homepage/hp/wagwan.png" width=35px></a> <button
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
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
						<a style="color: #D1D7E0;" class="nav-link" href="userliked.php">Likes</a>
					</li>
					<li class="nav-item">
						<a style="color: #D1D7E0;" class="nav-link"
							href="userprofile.php?UserId=<?php echo ($isLoggedIn == true) ? $UserId : "" ?>"><?php echo
									 	($isLoggedIn == true) ? $UserId : "Log In" ?></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<br>
	<h2 class="app-header"><strong>
			<?php echo "$UserId's" ?> Wagwans
		</strong></h2>
	<div class="container-fluid mt-5">
		<div class="row">
			<div class="col-lg-3">
				<div class="list-group">
					<a href="#" class="list-group-item list-group-item-action" id="account-management-link"
						onclick="openTab('account-management')">Account Management</a>
					<a href="#" class="list-group-item list-group-item-action " id="manage-wagwans-link"
						onclick="openTab('manage-wagwans')">Manage Wagwans</a>
				</div>
			</div>
			<div class="col-lg-9">
				<div id="account-management">
					<div class="card user-profile">
						<div class="card-header">
							<h3 class="text-center">Account Management</h3>
						</div>
						<div class="card-body">
							<form method="post" action="actions/updateAccount.php" enctype="multipart/form-data">
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" class="form-control" id="username" name="username"
										value="<?php echo $_SESSION['id']; ?>" required disabled>
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control" id="email" name="email"
										value="<?php echo $_SESSION['email']; ?>" required>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" id="password" name="password" required>
								</div>
								<div class="form-group">
									<label for="confirm_password">Confirm Password</label>
									<input type="password" class="form-control" id="confirm_password"
										name="confirm_password" required>
								</div>
								<!-- <div class="form-group">
									<label for="profile_picture">Profile Picture</label>
									<input type="file" class="form-control-file" id="profile_picture"
										name="profile_picture">
								</div> -->
								<div class="text-center">
									<button type="submit" class="btn btn-primary">Update</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div id="manage-wagwans">
					<div class="d-flex flex-row flex-nowrap overflow-auto" id="Top Posts">
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

						// get posts from posts table
						$sql = "SELECT * FROM dev_posts WHERE UserId = '$UserId'";
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
							array_push($likedPostsArray, $Event);
						}

						// reverse array so most recent posts are first
						$likedPostsArray = array_reverse($likedPostsArray);

						$row = 0; // keeps track of row we are on
						
						for ($i = 0; $i < count($likedPostsArray); $i++) {
							printEventMadeByUser($likedPostsArray[$i], $row);

							//layout for cards: 3 cards per row
							if (($i + 1) % 3 == 0) { // start a new div after every 3rd card
								echo "</div><br>";
								echo "<div class='d-flex flex-row flex-nowrap overflow-auto' id='Top Posts" . $i . "'>";

							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<!-- <a href="post.php" class="add-button"><i class="fas fa-plus"></i></a> -->

		<br>
</body>


</head>

</html>