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
echo "<!DOCTYPE html>\n";
echo "<html lang='en'>\n";
echo "<head>\n";
echo "<script>var id = '$UserId';</script>\n";
echo "<script>var isLoggedIn = true;</script>\n";

// CHANGE TABLE NAME HERE
$table_name = "dev_users";


$link = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);

if ($link->connect_error) {
	die("Connection failed: " . $link->connect_error);
}
$link->set_charset('utf8mb4');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$userid = $_SESSION["id"];
	$email = trim($_POST["email"]);
	$password = trim($_POST["password"]);
	$confirm_password = trim($_POST["confirm_password"]);

	$password_err = $confirm_password_err = $profile_pic_err = "";
	$success_msg = "";

	$profile_picture = $_FILES["profile_picture"]["name"];
	$target_dir = "profile_pictures/";
	$filename = $userid . "_" . basename($_FILES["profile_picture"]["name"]);
	$target_file = $target_dir . $filename;
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
	if (isset($_POST["submit"])) {
		$check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
		if ($check !== false) {
			$uploadOk = 1;
		} else {
			$profile_pic_err = "File is not an image.";
			$uploadOk = 0;
		}
	}

	// Check if file already exists
	if (file_exists($target_file)) {
		$profile_pic_err = "Sorry, file already exists.";
		$uploadOk = 0;
	}

	// Check file size
	if ($_FILES["profile_picture"]["size"] > 5000000) {
		$profile_pic_err = "Sorry, your file is too large.";
		$uploadOk = 0;
	}

	// Allow certain file formats
	if (
		$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif"
	) {
		$profile_pic_err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$profile_pic_err = "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
			$sql = "UPDATE $table_name SET ProfPic = ? WHERE UserId = ?";
			if ($stmt = mysqli_prepare($link, $sql)) {
				mysqli_stmt_bind_param($stmt, "ss", $filename, $userid);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
				$success_msg = "Profile Photo Successfully Updated";
				$_SESSION["ProfilePic"] = $filename;
			} else {
				die;
			}
		} else {
			$profile_pic_err = "Sorry, there was an error uploading your file.";
		}
	}

	if (!empty($email)) {

		$sql = "UPDATE $table_name SET Email = ? WHERE UserId = ?";
		if ($stmt = mysqli_prepare($link, $sql)) {
			mysqli_stmt_bind_param($stmt, "ss", $email, $userid);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			$success_msg = "Email Successfully Updated";
		} else {
			die;
		}
	}
	if (!empty($password) && strlen($password) < 6) {
		$password_err = "Password must contain at least 6 characters.";
	} else if ($password != $confirm_password) {
		$confirm_password_err = "Passwords do not match.";
	} else if (!empty($password) && !empty($confirm_password) && ($password == $confirm_password)) {
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		$sql = "UPDATE $table_name SET Password = ? WHERE UserId = ?";
		if ($stmt = mysqli_prepare($link, $sql)) {
			mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $userid);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			$success_msg = "Password Successfully Updated";
		}
	}

	//   if (!empty($profile_picture)) {
	//     $sql = "UPDATE dev_users SET ProfilePicture = ? WHERE UserId = ?";
	//     if($stmt = mysqli_prepare($link,

}
mysqli_close($link);


// Include Event class with php
require_once('Event.php');

// Include Event Object printer with php
require_once("postprinter.php");
?>
<link rel="stylesheet" href="./styles.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;900&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="js/functions.js"></script>

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



	<style>
		.list-group-item.active {
			background-color: #802BB1;;
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

		.text-primary {
			text-align: center;
		}
	</style>
	<link rel="icon" href="homepage/hp/icon.png">

	<?php
	echo "<title>$UserId's Profile</title>";
	?>
</head>


<body style="background-color:#211d2d; color:#D1D7E0;"
	onload=" openTab('manage-wagwans'); openTab('account-management');">
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #2D283E ;">
		<div class="container">
			<a class="navbar-brand" href="index.php"><img src="homepage/hp/wagwan.png" width="35" alt=""></a> <button
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
				<div class="text-center mt-3">
					<form action="actions/logout.php">
						<button type="submit" class="btn btn-danger">Log Out</button>
					</form>
				</div>
			</div>
			<div class="col-lg-9">
				<div id="account-management">
					<div class="card user-profile" style="border-radius: 1.25rem; background-color: #2D283E">
						<div class="card-header" style="border-radius: 1.15rem 1.15rem 0 0; background-color: #393748;">
							<h3 class="text-center">Account Management</h3>
						</div>
						<div class="card-body">
							<p class="text-primary">
								<?php echo $success_msg; ?>
							</p>
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
								enctype="multipart/form-data">
								<div class="form-group">
									<label for="username">Username</label>
									<input style="background-color: transparent ;" type="text" class="form-control" id="username" name="username"
										value="<?php echo $_SESSION['id']; ?>" required disabled>
								</div>
								<div class="form-group">
									<label for="email">New Email</label>
									<input style="background-color: transparent ;" type="email" class="form-control" id="email" name="email"
										value="<?php echo $_SESSION['email']; ?>">
								</div>
								<div class="form-group">
									<label for="password">New Password</label>
									<input style="background-color: transparent ;" type="password" class="form-control" id="password" name="password">
									<p class="text-danger" id="password_err">
										<?php echo $password_err; ?>
									</p>
								</div>
								<div class="form-group">
									<label for="confirm_password">Confirm New Password</label>
									<input style="background-color: transparent ;" type="password" class="form-control" id="confirm_password"
										name="confirm_password">
									<p class="text-danger" id="confirm_password_err">
										<?php echo $confirm_password_err; ?>
									</p>
								</div>
								<div class="form-group">
									<label for="profile_picture">Profile Picture</label>
									<input style="background-color: transparent ;"type="file" class="form-control-file" id="profile_picture"
										name="profile_picture">
									<p class="text-danger" id="profile_pic_err">
										<?php echo $profile_pic_err; ?>
									</p>
								</div>
								<div class="text-center">
									<button style="background-color: #802BB1; border:0px;" type="submit" class="btn btn-primary">Update</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div id="manage-wagwans">
					<div class="d-flex flex-row flex-nowrap overflow-auto" id="UserPosts0">
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

						$id = $UserId;

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
							$Event->setDateCreated($DateCreated);
							$Event->setSessionId($id);
							$Event->checkIfLiked($PostId);
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
								echo "<div class='d-flex flex-row flex-nowrap overflow-auto' id='UserPosts" . $i . "'>";

							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
		<!-- <a href="post.php" class="add-button"><i class="fas fa-plus"></i></a> -->

		<br>
</body>


</html>