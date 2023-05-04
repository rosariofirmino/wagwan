<?php
// prints a Event object to a card with php
// Usage: include_once("postprinter.php");

function printEvent($event, $row)
{
	// prints events to cards and modals
	echo "
	<!-- Card for " . $event->getTitle() . " -->
	<div class='card card-block mx-2' style='min-width: 400px; color: transparent; background-color: transparent; border: 0px;'>
		<img class='card-img-body' src='" . $event->getImg() . "' alt='' width='400' height='400' style='opacity: 0.6; border-radius: 1.25rem;'>

		<div class='card-img-overlay d-flex align-items-end' style='height: 400px; padding:2rem'>
			<button id='button" . $row . "" . $event->getPostId() . "' onClick='likeButtonPress(" . $row . ", " . $event->getPostId() . ", " . $event->getLikes() . ", " . $event->getLiked() . ")' type='button' class='align-self-end btn btn-dark' style='background-color: transparent; border-color: transparent;'>
					<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='white' class='bi bi-heart' viewBox='0 0 16 16'>
						<path id='path$row" . $event->getPostId() . "' d='" . $event->getLikedIcon() . "'/>
					</svg>
			</button>
			<h3 style='color: white' id='" . $row . "likes" . $event->getPostId() . "'>&nbsp; " . $event->getLikes() . "</h3>
		</div>

		<div class='card-img-overlay' style='height: 335px; padding:2rem; cursor: default;' data-toggle='modal' data-target='#modalpost" . $event->getPostId() . "row" . $row . "' onmouseover=\"this.style.cursor='pointer'\">

			<h3 style='color: white'>" . $event->getTitle() . "</h3>
			<p style='color: white'>" . $event->getDescription() . "</p>

		</div>
	</div>

  	<!-- Modal for " . $event->getTitle() . " -->
  	<div class='modal fade' id='modalpost" . $event->getPostId() . "row" . $row . "'>
		<div class='modal-dialog modal-dialog-centered' style='width:100%; max-width:750px;'>
			<div class='modal-content' style='border-radius:1.25rem'>
				
				<!-- Modal Header -->
				<div class='modal-header' style='display: inline; border-top-left-radius: 1rem; border-top-right-radius: 1rem; background-color: #4C495D;'>
					<h4 class='modal-title' style='padding: 5px'>" . $event->getTitle() . "</h4>
					<span style='background:#2D283E; border-radius: 10px; padding:5px;'><strong >Posted By: &nbsp; </strong><a href='userposted.php?UserId=" . $event->getUserId() . "'>" . $event->getUserId() . "</a></span>
					
				</div>
				
				<!-- Modal body --> 
				<div class='modal-body' style='background-color: #2D283E; padding: 25px 70px'>
				<div class='column'>
					<a href='#' class='tag' style='padding: 8px'>
					" . $event->getCategory() . "
					</a>
					<p><strong>Address: </strong><a href='https://maps.google.com/?q=" . str_replace(' ', '+', $event->getAddress()) . "' target='_blank' rel='noopener noreferrer'>" . $event->getAddress() . "</a></p>
					<p><strong>Description: </strong>" . $event->getDescription() . "</p>
					<p><strong>Age: </strong>" . $event->getAgeRestrictions() . "</p>
					<p><strong>Date: </strong>";
	$olddate = $event->getDateEvent();
	$dateTime = new DateTime($olddate);
	$newdate = $dateTime->format('l F jS Y \a\t g:i a');
	echo "$newdate</p>
					
				</div>

				<p><strong>Price: </strong> 
					
					<span class='price-container'>";
	if ($event->getPrice() == 0) {
		echo "<span><span style='font-size:40px; background:green; border-radius: 30px;'>🆓</span><span style='font-size:25px; filter:grayscale(100%)'> 💸 💰 💎</span></span>";
	}
	if ($event->getPrice() == 1) {
		echo "<span><span style='font-size:25px; filter:grayscale(100%)'>🆓 </span><span style='font-size:40px; background:green; border-radius: 30px;'>💸</span><span style='font-size:25px; filter:grayscale(100%)'> 💰 💎</span></span>";
	}
	if ($event->getPrice() == 2) {
		echo "<span><span style='font-size:25px; filter:grayscale(100%)'>🆓 💸 </span><span style='font-size:40px; background:green; border-radius: 30px;'>💰</span><span style='font-size:25px; filter:grayscale(100%)'> 💎</span></span>";
	}
	if ($event->getPrice() == 3) {
		echo "<span><span style='font-size:25px; filter:grayscale(100%)'>🆓 💸 💰 </span><span style='font-size:40px; background:green; border-radius: 30px;'>💎</span></span>";
	}

	echo "</span></p>


						<br>
					
					
					
					
					";



	if ($event->getRating() != 0) {
		echo "<p><strong>Rating: </strong><span id='stars" . $event->getPostId() . "" . $row . "'>" . $event->getRating() . "/5 stars</span></p>";
	} else {
		echo "<p><strong>Rating: </strong><span id='stars" . $event->getPostId() . "" . $row . "'>Not Yet Rated!</span></p>";
	}


	echo "<fieldset class='rating' style='position: relative; top: -25px;' disabled>
						<input type='radio' id='star5" . $event->getPostId() . "" . $row . "' name='rating" . $event->getPostId() . "" . $row . "' value='5'";
	if ($event->getRating() == 5) {
		echo "\x20 checked";
	}
	echo ">
						<label for='star5" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' id='star4" . $event->getPostId() . "" . $row . "' name='rating" . $event->getPostId() . "" . $row . "' value='4'";
	if ($event->getRating() >= 4 && $event->getRating() < 5) {
		echo "\x20 checked";
	}
	echo ">
						<label for='star4" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' id='star3" . $event->getPostId() . "" . $row . "' name='rating" . $event->getPostId() . "" . $row . "' value='3'";
	if ($event->getRating() >= 3 && $event->getRating() < 4) {
		echo "\x20 checked";
	}
	echo ">
						<label for='star3" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' id='star2" . $event->getPostId() . "" . $row . "' name='rating" . $event->getPostId() . "" . $row . "' value='2'";
	if ($event->getRating() >= 2 && $event->getRating() < 3) {
		echo "\x20 checked";
	}
	echo ">
						<label for='star2" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' id='star1" . $event->getPostId() . "" . $row . "' name='rating" . $event->getPostId() . "" . $row . "' value='1'";
	if ($event->getRating() >= 1 && $event->getRating() < 2) {
		echo "\x20 checked";
	}
	echo ">
						<label for='star1" . $event->getPostId() . "" . $row . "'></label>
				  	</fieldset>
					

					<br><br>

					<!-- User Rating -->";
	if ($event->getUserRating() == 0) {
		echo "<p><strong>Review this Wagwan:</strong></p>";
	} else {
		echo "<p><strong>Revise your review:</strong></p>";
	}
	echo "
					<fieldset class='rating' style='padding: 0px; margin: 0px; position: relative; top: -25px;'>
						<input type='radio' onClick='rating(" . $event->getPostId() . ", 5, " . $row . ")' id='userstar5" . $event->getPostId() . "" . $row . "' name='userrating" . $event->getPostId() . "" . $row . "' value='5'";
	if ($event->getUserRating() == 5) {
		echo "\x20 checked";
	}
	echo ">
						<label for='userstar5" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' onClick='rating(" . $event->getPostId() . ", 4, " . $row . ")' id='userstar4" . $event->getPostId() . "" . $row . "' name='userrating" . $event->getPostId() . "" . $row . "' value='4'";
	if ($event->getUserRating() == 4) {
		echo "\x20 checked";
	}
	echo ">
						<label for='userstar4" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' onClick='rating(" . $event->getPostId() . ", 3, " . $row . ")' id='userstar3" . $event->getPostId() . "" . $row . "' name='userrating" . $event->getPostId() . "" . $row . "' value='3'";
	if ($event->getUserRating() == 3) {
		echo "\x20 checked";
	}
	echo ">
						<label for='userstar3" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' onClick='rating(" . $event->getPostId() . ", 2, " . $row . ")' id='userstar2" . $event->getPostId() . "" . $row . "' name='userrating" . $event->getPostId() . "" . $row . "' value='2'";
	if ($event->getUserRating() == 2) {
		echo "\x20 checked";
	}
	echo ">
						<label for='userstar2" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' onClick='rating(" . $event->getPostId() . ", 1, " . $row . ")' id='userstar1" . $event->getPostId() . "" . $row . "' name='userrating" . $event->getPostId() . "" . $row . "' value='1'";
	if ($event->getUserRating() == 1) {
		echo "\x20 checked";
	}
	echo ">
						<label for='userstar1" . $event->getPostId() . "" . $row . "'></label>
				  	</fieldset>

				</div>
				
				<!-- Modal footer -->
				<div class='modal-footer' style='background-color: #2D283E; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem;' id='modalfooter" . $event->getPostId() . "row" . $row . "'>";
					$olddate = $event->getDateEvent();
					$dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $olddate);
					$newDateString = $dateTime->format('Ymd\THis');
					$link = "text=".str_replace(' ', '+', $event->getTitle())."&details=".str_replace(' ', '+', $event->getDescription())."&location=".str_replace(' ', '+', $event->getAddress())."&dates=".str_replace(' ', '+', $newDateString)."/".str_replace(' ', '+', $newDateString)."&ctz=America/New_York";
					$link = "&#039;https://calendar.google.com/calendar/r/eventedit?$link&#039;";
					echo "<button type='button' onclick='window.open($link, &#039;_blank&#039;)' class='btn btn-outline-success'>Calendar 📅</button>";
					echo "
					<button type='button' class='btn btn-outline-danger' data-dismiss='modal'>Close ❌</button>
				</div>
		
			</div>
  		</div>
	</div>
	";
}

function printEventMadeByUser($event, $row)
{
	// prints events to cards and modals; adds a button to delete post
	echo "
	<!-- Card for " . $event->getTitle() . " -->
	<div class='card card-block mx-2' style='min-width: 400px; color: transparent; background-color: transparent; border: 0px;'>
		<img class='card-img-body' src='" . $event->getImg() . "' alt='' width='400' height='400' style='opacity: 0.6; border-radius: 1.25rem;'>

		<div class='card-img-overlay d-flex align-items-end' style='height: 400px; padding:2rem'>
			<button id='button" . $row . "" . $event->getPostId() . "' onClick='likeButtonPress(" . $row . ", " . $event->getPostId() . ", " . $event->getLikes() . ", " . $event->getLiked() . ")' type='button' class='align-self-end btn btn-dark' style='background-color: transparent; border-color: transparent;'>
					<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='white' class='bi bi-heart' viewBox='0 0 16 16'>
						<path id='path$row" . $event->getPostId() . "' d='" . $event->getLikedIcon() . "'/>
					</svg>
			</button>
			<h3 style='color: white' id='" . $row . "likes" . $event->getPostId() . "'>&nbsp; " . $event->getLikes() . "</h3>
		</div>

		<div class='card-img-overlay' style='height: 335px; padding:2rem; cursor: default;' data-toggle='modal' data-target='#modalpost" . $event->getPostId() . "row" . $row . "' onmouseover=\"this.style.cursor='pointer'\">

			<h3 style='color: white'>" . $event->getTitle() . "</h3>
			<p style='color: white'>" . $event->getDescription() . "</p>

		</div>
	</div>

  	<!-- Modal for " . $event->getTitle() . " -->
  	<div class='modal fade' id='modalpost" . $event->getPostId() . "row" . $row . "'>
		<div class='modal-dialog modal-dialog-centered' style='width:100%; max-width:750px;'>
			<div class='modal-content' style='border-radius:1.25rem'>
				
				<!-- Modal Header -->
				<div class='modal-header' style='display: inline; border-top-left-radius: 1rem; border-top-right-radius: 1rem; background-color: #4C495D;'>
					<h4 class='modal-title' style='padding: 5px'>" . $event->getTitle() . "</h4>
					<span style='background:#2D283E; border-radius: 10px; padding:5px;'><strong >Posted By: &nbsp; </strong><a href='userprofile.php?UserId=" . $event->getUserId() . "'>" . $event->getUserId() . "</a></span>
					
				</div>
				
				<!-- Modal body --> 
				<div class='modal-body' style='background-color: #2D283E; padding: 25px 70px'>
				<div class='column'>
					<a href='#' class='tag' style='padding: 8px'>
					" . $event->getCategory() . "
					</a>
					<p><strong>Address: </strong><a href='https://maps.google.com/?q=" . str_replace(' ', '+', $event->getAddress()) . "' target='_blank' rel='noopener noreferrer'>" . $event->getAddress() . "</a></p>
					<p><strong>Description: </strong>" . $event->getDescription() . "</p>
					<p><strong>Age: </strong>" . $event->getAgeRestrictions() . "</p>
					<p><strong>Date: </strong>";
	$olddate = $event->getDateEvent();
	$dateTime = new DateTime($olddate);
	$newdate = $dateTime->format('l F jS Y \a\t g:i a');
	echo "$newdate</p>
					
				</div>

				<p><strong>Price: </strong> 
					
					<span class='price-container'>";
	if ($event->getPrice() == 0) {
		echo "<span><span style='font-size:40px; background:green; border-radius: 30px;'>🆓</span><span style='font-size:25px; filter:grayscale(100%)'> 💸 💰 💎</span></span>";
	}
	if ($event->getPrice() == 1) {
		echo "<span><span style='font-size:25px; filter:grayscale(100%)'>🆓 </span><span style='font-size:40px; background:green; border-radius: 30px;'>💸</span><span style='font-size:25px; filter:grayscale(100%)'> 💰 💎</span></span>";
	}
	if ($event->getPrice() == 2) {
		echo "<span><span style='font-size:25px; filter:grayscale(100%)'>🆓 💸 </span><span style='font-size:40px; background:green; border-radius: 30px;'>💰</span><span style='font-size:25px; filter:grayscale(100%)'> 💎</span></span>";
	}
	if ($event->getPrice() == 3) {
		echo "<span><span style='font-size:25px; filter:grayscale(100%)'>🆓 💸 💰 </span><span style='font-size:40px; background:green; border-radius: 30px;'>💎</span></span>";
	}

	echo "</span></p>


						<br>
					
					
					
					
					";



	if ($event->getRating() != 0) {
		echo "<p><strong>Rating: </strong><span id='stars" . $event->getPostId() . "" . $row . "'>" . $event->getRating() . "/5 stars</span></p>";
	} else {
		echo "<p><strong>Rating: </strong><span id='stars" . $event->getPostId() . "" . $row . "'>Not Yet Rated!</span></p>";
	}


	echo "<fieldset class='rating' style='position: relative; top: -25px;' disabled>
						<input type='radio' id='star5" . $event->getPostId() . "" . $row . "' name='rating" . $event->getPostId() . "" . $row . "' value='5' \x20";
	if ($event->getRating() == 5) {
		echo " checked";
	}
	echo ">
						<label for='star5" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' id='star4" . $event->getPostId() . "" . $row . "' name='rating" . $event->getPostId() . "" . $row . "' value='4' \x20";
	if ($event->getRating() >= 4 && $event->getRating() < 5) {
		echo " checked";
	}
	echo ">
						<label for='star4" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' id='star3" . $event->getPostId() . "" . $row . "' name='rating" . $event->getPostId() . "" . $row . "' value='3' \x20";
	if ($event->getRating() >= 3 && $event->getRating() < 4) {
		echo " checked";
	}
	echo ">
						<label for='star3" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' id='star2" . $event->getPostId() . "" . $row . "' name='rating" . $event->getPostId() . "" . $row . "' value='2' \x20";
	if ($event->getRating() >= 2 && $event->getRating() < 3) {
		echo " checked";
	}
	echo ">
						<label for='star2" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' id='star1" . $event->getPostId() . "" . $row . "' name='rating" . $event->getPostId() . "" . $row . "' value='1' \x20";
	if ($event->getRating() >= 1 && $event->getRating() < 2) {
		echo " checked";
	}
	echo ">
						<label for='star1" . $event->getPostId() . "" . $row . "'></label>
				  	</fieldset>
					

					<br><br>

					<!-- User Rating -->";
	if ($event->getUserRating() == 0) {
		echo "<p><strong>Review this Wagwan:</strong></p>";
	} else {
		echo "<p><strong>Revise your review:</strong></p>";
	}
	echo "
					<fieldset class='rating' style='padding: 0px; margin: 0px; position: relative; top: -25px;'>
						<input type='radio' onClick='rating(" . $event->getPostId() . ", 5, " . $row . ")' id='userstar5" . $event->getPostId() . "" . $row . "' name='userrating" . $event->getPostId() . "" . $row . "' value='5'\x20 ";
	if ($event->getUserRating() == 5) {
		echo " checked";
	}
	echo ">
						<label for='userstar5" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' onClick='rating(" . $event->getPostId() . ", 4, " . $row . ")' id='userstar4" . $event->getPostId() . "" . $row . "' name='userrating" . $event->getPostId() . "" . $row . "' value='4'\x20 ";
	if ($event->getUserRating() == 4) {
		echo " checked";
	}
	echo ">
						<label for='userstar4" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' onClick='rating(" . $event->getPostId() . ", 3, " . $row . ")' id='userstar3" . $event->getPostId() . "" . $row . "' name='userrating" . $event->getPostId() . "" . $row . "' value='3'\x20 ";
	if ($event->getUserRating() == 3) {
		echo " checked";
	}
	echo ">
						<label for='userstar3" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' onClick='rating(" . $event->getPostId() . ", 2, " . $row . ")' id='userstar2" . $event->getPostId() . "" . $row . "' name='userrating" . $event->getPostId() . "" . $row . "' value='2' \x20";
	if ($event->getUserRating() == 2) {
		echo " checked";
	}
	echo ">
						<label for='userstar2" . $event->getPostId() . "" . $row . "'></label>
						<input type='radio' onClick='rating(" . $event->getPostId() . ", 1, " . $row . ")' id='userstar1" . $event->getPostId() . "" . $row . "' name='userrating" . $event->getPostId() . "" . $row . "' value='1'\x20";
	if ($event->getUserRating() == 1) {
		echo " checked";
	}
	echo ">
						<label for='userstar1" . $event->getPostId() . "" . $row . "'></label>
				  	</fieldset>

				</div>
				
				<!-- Modal footer -->
				<div class='modal-footer' style='background-color: #2D283E; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem;' id='modalfooter" . $event->getPostId() . "row" . $row . "'>
					<button type='button' class='btn btn-danger' data-dismiss='modal' onClick='deletePost(" . $event->getPostId() . ")'>Delete this Wagwan 🗑️</button>	
					<button type='button' class='btn btn-danger' data-dismiss='modal'>Close ❌</button>
				</div>
		
			</div>
  		</div>
	</div>
	";
}





?>