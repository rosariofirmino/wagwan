#!/usr/local/bin/php
<?php
	//Database connection
	$conn = new mysqli("mysql.cise.ufl.edu", "dpayne1", "password", "Wagwan");
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$PostId = $_GET["PostId"];
	$Row = $_GET["Row"];

	// get ratings from ratings table matching postid
	$sql = "SELECT * FROM dev_ratings WHERE PostId = $PostId";
	$result = $conn->query($sql);
	
	// check how many results and add ratings together
	$ratings = 0;
	$total = 0;
	while($row = $result->fetch_assoc())
	{
		$total += $row["Rating"];
		$ratings++;
	}

	$rating = $total/$ratings;

	if ($ratings == 0) {
		//echo "Not Yet Rated";
		$rating = 0;
	}
	else {
		//echo "Rating: ".$rating;
		$rating = round($rating, 2);
	}

	// update ratings in posts table
	$sql = "UPDATE dev_posts SET Rating = $rating WHERE PostId = $PostId";
	$result = $conn->query($sql);

	$data = array(
		'rating' => $rating,
		'row' => $Row
	);

	$json = json_encode($data);

	echo $json;

	

	$conn->close();
?>
