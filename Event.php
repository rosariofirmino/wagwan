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
	public function checkIfLiked($PostId)
	{
		// checks if post is liked and updates likedIcon.
		$conn = new mysqli("mysql.cise.ufl.edu", "dpayne1", "password", "Wagwan");
		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}

		$UserId = "admin"; // get from session, admin is temporary...

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
	public function setImg($ImageId) {
		// set image based on ImageId
		$this->img = "posts_images/".$ImageId.".jpeg";
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

?>