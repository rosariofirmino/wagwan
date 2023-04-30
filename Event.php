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


	public function __construct($title, $description, $category, $rating, $AgeRestrictions, $DateEvent, $Price, $Address, $UserId, $PostId)
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
?>