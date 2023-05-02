#!/usr/local/bin/php

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
<html>

<head>
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
			<a class="navbar-brand" href="#"><img src="Homepage/hp/wagwan.png" width=35px></a> <button
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
						<a style="color: #D1D7E0;" class="nav-link" href="userprofile.php?UserId=admin">Account</a>
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
				<img alt="..." class="d-block w-100" src="Homepage/hp/gv2.jpeg">
			</div>
			<div class="carousel-item">
				<img alt="..." class="d-block w-100" src="Homepage/hp/gv1.jpeg">
			</div>
			<div class="carousel-item">
				<img alt="..." class="d-block w-100" src="Homepage/hp/gv3.jpeg">
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