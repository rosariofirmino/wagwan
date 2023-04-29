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

</head>

<script>
function like(title) {
	console.log("test");

}
</script>

<?php
// making Event class with php
class Event
{
	private $title;
	private $description;
	private $category;
	private $img;
	private $likes;
	private $liked = false;
	private $likedIcon = "m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z";
	private $rating;
	private $AgeRestrictions;
	private $DateEvent;
	private $Price;
	private $Address;
	private $UserId;
	private $PostId;


	public function __construct($title, $description, $category, $rating, $AgeRestrictions, $DateEvent, $Price, $Address, $UserId, $PostId)
	{
		$this->title = $title;
		$this->description = $description;
		$this->category = $category;
		$this->likes = rand(1, 100); //random like amount for now
		$this->liked = false;
		$this->rating = $rating;
		$this->AgeRestrictions = $AgeRestrictions;
		$this->DateEvent = $DateEvent;
		$this->Price = $Price;
		$this->Address = $Address;
		$this->UserId = $UserId;
		$this->PostId = $PostId;


		$this->img = "https://www.squareclub.si/images/hero/2.jpg"; //default image i guess
		if ($category == "nightlife") {
			$this->img = "https://www.squareclub.si/images/hero/2.jpg";
		}
		if ($category == "market") {
			$this->img = "https://bloximages.chicago2.vip.townnews.com/tucson.com/content/tncms/assets/v3/editorial/6/45/645ff446-eb80-5fcc-bc85-c6e7d8ea091f/5fb81c841e82f.image.jpg?resize=1200%2C900";
		}
		if ($category == "concert") {
			$this->img = "https://upload.wikimedia.org/wikipedia/commons/c/cb/Classical_spectacular10.jpg";
		}
		if ($category == "food") {
			$this->img = "https://cdn.vox-cdn.com/thumbor/5d_RtADj8ncnVqh-afV3mU-XQv0=/0x0:1600x1067/1200x900/filters:focal(672x406:928x662)/cdn.vox-cdn.com/uploads/chorus_image/image/57698831/51951042270_78ea1e8590_h.7.jpg";
		}
		if ($category == "museum") {
			$this->img = "https://www.ringling.org/sites/default/files/styles/800x450_mcrop/public/basic_page_image/DSC00490_web_0.jpg?itok=kgk7MO8l";
		}
	}

	public function getTitle()
	{
		return $this->title;
	}
	public function getDescription()
	{
		return $this->description;
	}
	public function getCategory()
	{
		return $this->category;
	}
	public function getImg()
	{
		return $this->img;
	}
	public function getLikes()
	{
		return $this->likes;
	}
	public function getLikedIcon()
	{
		return $this->likedIcon;
	}

}
?>

<body>

	<body style="background-color: black; color: white;">
		<div id="root"></div>
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

			$sql = "SELECT * FROM homepage_posts_test";
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


			for ($i = 0; $i < count($topPostsArray); $i++) {
				echo "<div id='card' class='card card-block mx-2' style='min-width: 400px'>
            <img class='card-img-body' src='" . $topPostsArray[$i]->getImg() . "' alt='Card image' width='400px' height='400px' style='opacity: 0.3'></img>
            <div class='card-img-overlay'>
    
              <h3 style='color: white'>" . $topPostsArray[$i]->getTitle() . "</h3>
    
              <p style='color: white'>" . $topPostsArray[$i]->getDescription() . "</p>
    
            </div>
            <div class='card-img-overlay d-flex align-items-end'>
              <button onClick='like('testing')' type='button' class='align-self-end btn btn-dark'>
                      <svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='white' class='bi bi-heart' viewBox='0 0 16 16'>
                        <path d='" . $topPostsArray[$i]->getLikedIcon() . "'}/>
                      </svg>
              </button>
              <h3 style='color: white'>&nbsp; " . $topPostsArray[$i]->getLikes() . "</h3>
            </div>
          </div>";
			}
			?>
		</div>
		<br>
		<h2><strong>Wagwan Tonight</strong></h2>
		<div class="d-flex flex-row flex-nowrap overflow-auto" id="Tonight">
			<?php

			for ($i = 0; $i < count($topPostsArray); $i++) {
				echo "<div id='card' class='card card-block mx-2' style='min-width: 400px'>
            <img class='card-img-body' src='" . $topPostsArray[$i]->getImg() . "' alt='Card image' width='400px' height='400px' style='opacity: 0.3'></img>
            <div class='card-img-overlay'>
    
              <h3 style='color: white'>" . $topPostsArray[$i]->getTitle() . "</h3>
    
              <p style='color: white'>" . $topPostsArray[$i]->getDescription() . "</p>
    
            </div>
            <div class='card-img-overlay d-flex align-items-end'>
              <button onClick={} type='button' class='align-self-end btn btn-dark'>
                      <svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='white' class='bi bi-heart' viewBox='0 0 16 16'>
                        <path d='" . $topPostsArray[$i]->getLikedIcon() . "'}/>
                      </svg>
              </button>
              <h3 style='color: white'>&nbsp; " . $topPostsArray[$i]->getLikes() . "</h3>
            </div>
          </div>";
			}
			?>
		</div>
		<br>
		<h2><strong>Wagwan this Weekend</strong></h2>
		<div class="d-flex flex-row flex-nowrap overflow-auto" id="Weekend">
			<?php

			for ($i = 0; $i < count($topPostsArray); $i++) {
				echo "<div id='card' class='card card-block mx-2' style='min-width: 400px'>
            <img class='card-img-body' src='" . $topPostsArray[$i]->getImg() . "' alt='Card image' width='400px' height='400px' style='opacity: 0.3'></img>
            <div class='card-img-overlay'>
    
              <h3 style='color: white'>" . $topPostsArray[$i]->getTitle() . "</h3>
    
              <p style='color: white'>" . $topPostsArray[$i]->getDescription() . "</p>
    
            </div>
            <div class='card-img-overlay d-flex align-items-end'>
              <button onClick={} type='button' class='align-self-end btn btn-dark'>
                      <svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='white' class='bi bi-heart' viewBox='0 0 16 16'>
                        <path d='" . $topPostsArray[$i]->getLikedIcon() . "'}/>
                      </svg>
              </button>
              <h3 style='color: white'>&nbsp; " . $topPostsArray[$i]->getLikes() . "</h3>
            </div>
          </div>";
			}
			?>
		</div>
		<br>
		<h2><strong>Your liked Wagwans</strong></h2>
		<div class="d-flex flex-row flex-nowrap overflow-auto" id="Liked">
			<?php

			for ($i = 0; $i < count($topPostsArray); $i++) {
				echo "<div id='card' class='card card-block mx-2' style='min-width: 400px'>
            <img class='card-img-body' src='" . $topPostsArray[$i]->getImg() . "' alt='Card image' width='400px' height='400px' style='opacity: 0.3'></img>
            <div class='card-img-overlay'>
    
              <h3 style='color: white'>" . $topPostsArray[$i]->getTitle() . "</h3>
    
              <p style='color: white'>" . $topPostsArray[$i]->getDescription() . "</p>
    
            </div>
            <div class='card-img-overlay d-flex align-items-end'>
              <button onClick={} type='button' class='align-self-end btn btn-dark'>
                      <svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='white' class='bi bi-heart' viewBox='0 0 16 16'>
                        <path d='" . $topPostsArray[$i]->getLikedIcon() . "'}/>
                      </svg>
              </button>
              <h3 style='color: white'>&nbsp; " . $topPostsArray[$i]->getLikes() . "</h3>
            </div>
          </div>";
			}
			?>
		</div>
	</body>
</body>

</html>