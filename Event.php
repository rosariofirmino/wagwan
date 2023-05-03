<?php
// Event class with php
// Usage: include_once("Event.php");

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
	private $DateCreated;
	private $UserRating;
	private $sessionId;


	public function __construct($title, $description, $category, $rating, $AgeRestrictions, $DateEvent, $Price, $Address, $UserId, $PostId, $ImageId)
	{
		$this->title = $title;
		$this->description = $description;
		$this->category = $category;
		$this->liked = false;
		$this->rating = $rating;
		$this->AgeRestrictions = $AgeRestrictions;
		$this->DateEvent = $DateEvent;
		$this->Price = $Price;
		$this->Address = $Address;
		$this->UserId = $UserId;
		$this->PostId = $PostId;
		$this->liked = false;

		$this->checkIfLiked($PostId);
		$this->calculateLikes($PostId);

		$this->img = "https://www.squareclub.si/images/hero/2.jpg"; //default image
		$this->setImg($ImageId);
	}

	public function setSessionId($id){
		$this->sessionid = $id;
		$this->setUserRating();
	}

	public function checkIfLiked($PostId)
	{
		// checks if post is liked and updates likedIcon.
		$conn = new mysqli("mysql.cise.ufl.edu", "dpayne1", "password", "Wagwan");
		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}

		$UserId = $this->sessionid; // get from session

		// get liked posts from likes table matching userid and postid
		$sql = "SELECT LikeId FROM dev_likes WHERE UserId = '$UserId' AND PostId = $PostId";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if($row['LikeId'] > 0)
		{
			$this->liked = true;
			$this->likedIcon = "M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z";
		}
	}
	public function calculateLikes($PostId) {
		$conn = new mysqli("mysql.cise.ufl.edu", "dpayne1", "password", "Wagwan");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// get likes from likes table matching postid
		$sql = "SELECT * FROM dev_likes WHERE PostId = $PostId";
		$result = $conn->query($sql);
		
		// check how many results
		$likes = 0;
		while($row = $result->fetch_assoc())
		{
			$likes++;
		}

		// update object
		$this->likes = $likes;

	}

	function setUserRating() {
		$conn = new mysqli("mysql.cise.ufl.edu", "dpayne1", "password", "Wagwan");
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		$PostId = $this->PostId;
		$UserId = $this->sessionid;
		$sql = "SELECT * FROM dev_ratings WHERE PostId = $PostId AND UserId = '$UserId'";
		$result = $conn->query($sql);

		$this->UserRating = 0;
		while ($row = $result->fetch_assoc()) {
			$this->UserRating = $row['Rating'];
		}

	}

	function getUserRating() {
		return $this->UserRating;
	}

	public function setImg($ImageId) {
		// set image based on ImageId
		$this->img = "posts_images/".$ImageId.".jpeg";
	}
	public function setDateCreated($DateCreated)
	{
		$this->DateCreated = $DateCreated;
	}
	public function getDateCreated()
	{
		return $this->DateCreated;
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
	public function getLiked()
	{
		if ($this->liked == true) {
			return "true";
		}
		else {
			return "false";
		}
	}
	public function getPostId()
	{
		return $this->PostId;
	}
	public function getRating()
	{
		return $this->rating;
	}
	public function getAgeRestrictions()
	{
		return $this->AgeRestrictions;
	}
	public function getDateEvent()
	{
		return $this->DateEvent;
	}
	public function getPrice()
	{
		return $this->Price;
	}
	public function getAddress()
	{
		return $this->Address;
	}
	public function getUserId()
	{
		return $this->UserId;
	}
	


}

function compareLikes($a, $b) {
	// compares likes of two posts, used to sort array of posts
	// use: usort($postsArr, 'compareLikes');
	if ($a->getLikes() == $b->getLikes()) {
		return 0;
	}
	return ($a->getLikes() > $b->getLikes()) ? -1 : 1;
}

function compareRating($a, $b) {
	// compares ratings of two posts, used to sort array of posts by rating
	// use: usort($postsArr, 'compareRating');
	if ($a->getRating() == $b->getRating()) {
		return 0;
	}
	return ($a->getRating() > $b->getRating()) ? -1 : 1;
}

function compareDateEvent($a, $b) {
	// compares dates of two posts, used to sort array of posts by date event
	// use: usort($postsArr, 'compareDateEvent');
	$dateA = strtotime($a->getDateEvent());
	$dateB = strtotime($b->getDateEvent());
	if ($dateA == $dateB) {
		return 0;
	}
	return ($dateA < $dateB) ? -1 : 1;
}

function compareDateCreated($a, $b) {
	// compares dates of two posts, used to sort array of posts by date created
	// use: usort($postsArr, 'compareDateCreated');
	$dateA = strtotime($a->getDateCreated());
	$dateB = strtotime($b->getDateCreated());
	if ($dateA == $dateB) {
		return 0;
	}
	return ($dateA > $dateB) ? -1 : 1;
}

function removeIfDatePassed($arr) {
	// removes posts from array if the event's date has passed
	// use: $postsArr = removeIfDatePassed($postsArr);
	$today = date('Y-m-d H:i:s');
	foreach($arr as $key => $value) {
        if($value->getDateEvent() < $today) {
            unset($arr[$key]);
        }
    }

	return $arr;
}

function removeIfDateFar($arr, $days) {
	// removes posts from array if the event's date is more than $days away
	// use: $postsArr = removeIfDateFar($postsArr, 7);
	$date = date('Y-m-d H:i:s', strtotime('+'.$days.' days'));

	foreach($arr as $key => $value) {
        if($value->getDateEvent() > $date) {
            unset($arr[$key]);
        }
	}

	return $arr;
}

function removeIfRatingLow($arr, $rating) {
	// removes posts from array if the rating is less than $rating
	// use: $postsArr = removeIfRatingLow($postsArr, 4);
	foreach($arr as $key => $value) {
		if($value->getRating() < $rating) {
			unset($arr[$key]);
		}
	}

	return $arr;
}

function keepXPriceOnly($arr, $x) {
	// keeps only posts from array with $x price (0, 1, 2, 3)
	// use: $postsArr = keepXPriceOnly($postsArr, 0) to get free events;
	foreach($arr as $key => $value) {
		if($value->getPrice() != $x) {
			unset($arr[$key]);
		}
	}
	
	return $arr;
}

function keepAgeGroupOnly($arr, $age) {
	// keeps only posts from array with $age age group ("All Ages", "18+", "21+")
	// use: $postsArr = keepAgeGroupOnly($postsArr, "All Ages") to get all age groups;

	foreach($arr as $key => $value) {
		if($value->getAgeRestrictions() != $age) {
			unset($arr[$key]);
		}
	}
	
	return $arr;
}

function keepLiked($arr) {
	// keeps only posts from array that are liked by user
	// use: $postsArr = keepLiked($postsArr);
	foreach($arr as $key => $value) {
		if($value->getLiked() == 'false') {
			unset($arr[$key]);
		}
	}
	
	return $arr;
}

?>