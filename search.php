#!/usr/local/bin/php

<?php
session_start();
echo "<!DOCTYPE html>\n<html lang='en'>\n<head>\n";
// Check if the user is already logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ./index.php");
    exit;
}
else {
	$isLoggedIn = true;
	$id = $_SESSION["id"];
	
}

// Include Event class with php
require_once('Event.php');

// Include Event Object printer with php
require_once("postprinter.php");
	?>

<style>
	* {
		font-family: 'Montserrat', sans-serif;
	}

	.bg-dark {
		background-color: #2D283E !important;
	}

	.carousel-item {
		height: 100vh;
		min-height: 300px;
	}

	.carousel-caption {
		bottom: 220px;
	}

	.add-button {
		z-index: 10;
	}

	.carousel-caption h5 {
		font-size: 45px;
		text-transform: uppercase;
		letter-spacing: 2px;
		margin-top: 25px;
	}

	.carousel-caption p {
		width: 60%;
		margin: auto;
		font-size: 18px;
		line-height: 1.9;
	}

	.carousel-caption a {
		text-transform: uppercase;
		text-decoration: none;
		background: darkorange;
		padding: 10px 30px;
		display: inline-block;
		color: #000;
		margin-top: 15px;
	}

	.navbar-nav a {
		font-size: 18px;
		text-transform: uppercase;
		font-weight: bold;
	}

	.navbar-light .navbar-brand {
		color: #fff;
		font-size: 25px;
		text-transform: uppercase;
		font-weight: bold;
		letter-spacing: 2px;
	}

	.navbar-light .navbar-brand:focus,
	.navbar-light .navbar-brand:hover {
		color: #fff;
	}

	.navbar-light .navbar-nav .nav-link {
		color: #fff;
	}

	.navbar-light .navbar-nav .nav-link:focus,
	.navbar-light .navbar-nav .nav-link:hover {
		color: #fff;
	}

	.w-100 {
		height: 100vh;
	}

	.navbar-toggler {
		padding: 1px 5px;
		font-size: 18px;
		line-height: 0.3;
		background: #fff;
	}

	.centered {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);

		text-transform: uppercase;
		color: #fff;
	}

	img {
		object-fit: cover;
	}

	.modal-header {
		border-top-left-radius: 1.25rem;
		border-top-right-radius: calc(1.25rem - 1px);
		background-color: #212529;
		color: white;
	}

	.modal-body {
		background-color: #212529;
		color: white;
	}

	.modal-footer {
		background-color: #212529;
		color: white;
	}

	.modal-content {
		border-radius: 1.25rem;
	}

	.titletext {
		font-size: 60px;
	}

	.input-group-append {
		border-radius: 50px;
	}

	@media only screen and (max-width: 767px) {
		.navbar-nav {
			text-align: center;
			background: rgba(0, 0, 0, 0.5);
		}

		.carousel-caption {
			bottom: 165px;
		}

		.carousel-caption h5 {
			font-size: 17px;
		}

		.carousel-caption a {
			padding: 10px 15px;
			font-size: 15px;
		}
	}
</style>

	<title>Wagwan Home Page</title>
	<link rel="stylesheet" href="./styles.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;900&display=swap" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/your_code.js" crossorigin="anonymous"></script>
	<script src="js/functions.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
	<script src="./js/search_ajax.js"></script>
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
			<a class="navbar-brand" href="index.php"><img src="homepage/hp/wagwan.png" alt="" width='35'></a> <button
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
	<br><br><br><br>
	<div class="row justify-content-center">
		<div class="col-11">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
				<div class="row">
					<div class="form-group mb-3">
						<input type="text" class="form-control" name="text" placeholder="Enter name or location">
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col">
						<div class="input-group mb-3">
							<div class="form-group">
								<label>Category</label>
								<select class="form-control" id="category" name="category">
								<option value="any">Any</option>
								<option value="nightlife">Nightlife</option>
								<option value="shop">Shop</option>
								<option value="performance">Performance</option>
								<option value="food">Food</option>
								<option value="activity">Activity</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="input-group mb-3">
							<div class="form-group">
								<label for="price">Price</label>
								<select class="form-control" id="price" name="price">
								<option value="any">Any</option>
								<option value="0">🆓</option>
								<option value="1">💸</option>
								<option value="2">💰</option>
								<option value="3">💎</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="input-group mb-3">
							<div class="form-group">
								<label for="age">Age</label>
								<select class="form-control" id="age" name="age">
								<option value="any">All Ages</option>
								<option value="18+">18+</option>
								<option value="21+">21+</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="input-group mb-3">
							<div class="form-group">
								<input type="submit" class="btn btn-dark" value="Search">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<br>




<?php

$config = parse_ini_file("./db_config.ini");

$link = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
if ($link->linkect_error) {
  die("linkection failed: " . $link->linkect_error);
}

if($_SERVER["REQUEST_METHOD"] == "GET"){
	$text = $_GET['text'];
	$category = $_GET['category'];
	$price = $_GET['price'];
	$age = $_GET['age'];

	$sql = "SELECT * from dev_posts where (Address like ? OR Description like ? OR Title like ?)";

	if($category != "any" && !empty($category) && $category !== "") {
		$sql = $sql . " AND CategoryId = '" . $category . "'";
	}
	if($price != "any" && (!empty($price) || $price == 0) && $price !== "") {
		$sql = $sql . " AND Price = '" . $price . "'";
	}
	if($age != "any" && !empty($age) && $age !== "") {
		$sql = $sql . " AND AgeRestrictions = '" . $age . "'";
	}

	if ($stmt = mysqli_prepare($link, $sql)) {
		mysqli_stmt_bind_param($stmt, "sss", $text_param, $text_param, $text_param);
		$text_param = '%' . $text . '%';

        if(mysqli_stmt_execute($stmt)){
			//mysqli_stmt_store_result($stmt);
            $result = $stmt->get_result();
			echo "Query success";
        } else{
            echo "Error execute";
        }
	}
	else {
        echo "Error prepare";
    }

	if(mysqli_stmt_num_rows($stmt) == 0) {
		echo "";
	}
	
	$searchArray = array();

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
        $ImageId = htmlspecialchars($row["ImageId"]);

        $Event = new Event($Title, $Description, $CategoryId, $Rating, $AgeRestrictions, $DateEvent, $Price, $Address, $UserId, $PostId, $ImageId);
		$Event->setSessionId($id);
		$Event->checkIfLiked($PostId);
		array_push($searchArray, $Event);
    }

	// Sort based on liked count
	usort($searchArray, 'compareLikes');

	$row = 0; // keeps track of row we are on
	$i = 0; // keeps track of card we are on
	echo "<div class='PostsContainer' style=''> <h1>Search Results</h1>";
	echo "<div class='d-flex flex-row flex-nowrap overflow-auto' id='SearchPosts" . $row . "'>";
	foreach ($searchArray as $key => $value) {
		printEvent($value, $row);
		if (($i + 1) % 3 == 0) { // start a new div after every 3rd card
			echo "</div><br>";
			echo "<div class='d-flex flex-row flex-nowrap overflow-auto' id='SearchPosts" . $i . "'>";
			$row++;
		}
		$i++;
	}
	echo "</div>";
	echo "</div>";

    // Close the database linkection
    mysqli_close($link);

}
?>
</body>
</html>
