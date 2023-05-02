<?php
// prints a Event object to a card with php
// Usage: include_once("postprinter.php");

function printEvent($event, $row) {
	// prints events to cards and modals
	echo "
	<!-- Card for ".$event->getTitle()." -->
	<div id='card' class='card card-block mx-2' style='min-width: 400px'>
		<img class='card-img-body' src='" . $event->getImg() . "' alt='Card image' width='400px' height='400px' style='opacity: 0.3'></img>

		<div class='card-img-overlay d-flex align-items-end' style='height: 400px'>
			<button id='button".$row."".$event->getPostId()."' onClick='likeButtonPress(".$row.", ".$event->getPostId().", ".$event->getLikes().", ".$event->getLiked().")' type='button' class='align-self-end btn btn-dark'>
					<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='white' class='bi bi-heart' viewBox='0 0 16 16'>
						<path id='".$row."path".$event->getPostId()."' d='" . $event->getLikedIcon() . "'}/>
					</svg>
			</button>
			<h3 style='color: white' id='".$row."likes".$event->getPostId()."'>&nbsp; " . $event->getLikes() . "</h3>
		</div>

		<div class='card-img-overlay' style='height: 335px' data-toggle='modal' data-target='#modalpost".$event->getPostId()."row".$row."'  style='cursor: default;' onmouseover=\"this.style.cursor='pointer'\">

			<h3 style='color: white'>" . $event->getTitle() . "</h3>
			<p style='color: white'>" . $event->getDescription() . "</p>

		</div>
	</div>

  	<!-- Modal for ".$event->getTitle()." -->
  	<div class='modal fade' id='modalpost".$event->getPostId()."row".$row."'>
		<div class='modal-dialog modal-dialog-centered'>
			<div class='modal-content'>
				
				<!-- Modal Header -->
				<div class='modal-header'>
					<h4 class='modal-title'>". $event->getTitle() ."</h4>
				</div>
				
				<!-- Modal body -->
				<div class='modal-body'>
					<p><strong>Posted By: </strong><a href=userprofile.php?UserId=".$event->getUserId().">".$event->getUserId()."</a></p>
					<p><strong>Address: </strong>".$event->getAddress()."</p>
					<p><strong>Category: </strong>".$event->getCategory()."</p>
					<p><strong>Description: </strong>".$event->getDescription()."</p>
					<p><strong>Price: </strong> 
					
					<span class='price-container'>";
					if ($event->getPrice() == 1) {
						echo "<span><span style='font-size:40px;'>💲 </span><span style='font-size:25px; filter:grayscale(100%)'> 💸 💰</span></span>";
					}
					if ($event->getPrice() == 2) {
						echo "<span><span style='font-size:25px; filter:grayscale(100%)'>💲 </span><span style='font-size:40px;'>💸</span><span style='font-size:25px; filter:grayscale(100%)'> 💰</span></span>";
					}
					if ($event->getPrice() == 3) {
						echo "<span><span style='font-size:25px; filter:grayscale(100%)'>💲 💸 </span><span style='font-size:40px;'>💰</span></span>";
					}

					echo "</p></span>
					<p><strong>Age: </strong>".$event->getAgeRestrictions()."</p>
					<p><strong>Date: </strong>";
					$olddate = $event->getDateEvent();
					$dateTime = new DateTime($olddate);
					$newdate = $dateTime->format('l F jS Y \a\t g:i a');
					echo "$newdate</p>
					<p><strong>Rating: </strong>".$event->getRating()."/5 stars </p>

					<fieldset class='rating' style='position: relative; top: -25px;'>
						<input type='radio' id='star5".$event->getPostId()."".$row."' name='rating".$event->getPostId()."".$row."' value='5'";
						if ($event->getRating() == 5) {
							echo " checked";
						}
						else {
							echo " disabled";
						}
						echo ">
						<label for='star5".$event->getPostId()."".$row."'></label>
						<input type='radio' id='star4".$event->getPostId()."".$row."' name='rating".$event->getPostId()."".$row."' value='4'";
						if ($event->getRating() == 4) {
							echo " checked";
						}
						else {
							echo " disabled";
						}
						echo ">
						<label for='star4".$event->getPostId()."".$row."'></label>
						<input type='radio' id='star3".$event->getPostId()."".$row."' name='rating".$event->getPostId()."".$row."' value='3'";
						if ($event->getRating() == 3) {
							echo " checked";
						}
						else {
							echo " disabled";
						}
						echo ">
						<label for='star3".$event->getPostId()."".$row."'></label>
						<input type='radio' id='star2".$event->getPostId()."".$row."' name='rating".$event->getPostId()."".$row."' value='2'";
						if ($event->getRating() == 2) {
							echo " checked";
						}
						else {
							echo " disabled";
						}
						echo ">
						<label for='star2".$event->getPostId()."".$row."'></label>
						<input type='radio' id='star1".$event->getPostId()."".$row."' name='rating".$event->getPostId()."".$row."' value='1'";
						if ($event->getRating() == 1) {
							echo " checked";
						}
						else {
							echo " disabled";
						}
						echo ">
						<label for='star1".$event->getPostId()."".$row."'></label>
				  	</fieldset>
					

					<br><br>

					<!-- User Rating -->
					<p><strong>Rate this event: </strong></p>
					<fieldset class='rating' style='padding: 0px; margin: 0px;'>
						<input type='radio' id='userstar5".$event->getPostId()."".$row."' name='userrating".$event->getPostId()."".$row."' value='5'>
						<label for='userstar5".$event->getPostId()."".$row."'></label>
						<input type='radio' id='userstar4".$event->getPostId()."".$row."' name='userrating".$event->getPostId()."".$row."' value='4'>
						<label for='userstar4".$event->getPostId()."".$row."'></label>
						<input type='radio' id='userstar3".$event->getPostId()."".$row."' name='userrating".$event->getPostId()."".$row."' value='3'>
						<label for='userstar3".$event->getPostId()."".$row."'></label>
						<input type='radio' id='userstar2".$event->getPostId()."".$row."' name='userrating".$event->getPostId()."".$row."' value='2'>
						<label for='userstar2".$event->getPostId()."".$row."'></label>
						<input type='radio' id='userstar1".$event->getPostId()."".$row."' name='userrating".$event->getPostId()."".$row."' value='1'>
						<label for='userstar1".$event->getPostId()."".$row."'></label>
				  	</fieldset>

				</div>
				
				<!-- Modal footer -->
				<div class='modal-footer' id='modalfooter".$event->getPostId()."row".$row."'>
					<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
		
			</div>
  		</div>
	</div>
	";
}

function printEventMadeByUser($event, $row) {
	// prints events to cards and modals; adds a button to delete post
	echo "
	<!-- Card for ".$event->getTitle()." -->
	<div id='card' class='card card-block mx-2' style='min-width: 400px'>
		<img class='card-img-body' src='" . $event->getImg() . "' alt='Card image' width='400px' height='400px' style='opacity: 0.3'></img>

		<div class='card-img-overlay d-flex align-items-end' style='height: 400px'>
			<button id='button".$row."".$event->getPostId()."' onClick='likeButtonPress(".$row.", ".$event->getPostId().", ".$event->getLikes().", ".$event->getLiked().")' type='button' class='align-self-end btn btn-dark'>
					<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='white' class='bi bi-heart' viewBox='0 0 16 16'>
						<path id='".$row."path".$event->getPostId()."' d='" . $event->getLikedIcon() . "'}/>
					</svg>
			</button>
			<h3 style='color: white' id='".$row."likes".$event->getPostId()."'>&nbsp; " . $event->getLikes() . "</h3>
		</div>

		<div class='card-img-overlay' style='height: 335px' data-toggle='modal' data-target='#modalpost".$event->getPostId()."row".$row."'  style='cursor: default;' onmouseover=\"this.style.cursor='pointer'\">

			<h3 style='color: white'>" . $event->getTitle() . "</h3>
			<p style='color: white'>" . $event->getDescription() . "</p>

		</div>
	</div>

  	<!-- Modal for ".$event->getTitle()." -->
  	<div class='modal fade' id='modalpost".$event->getPostId()."row".$row."'>
		<div class='modal-dialog modal-dialog-centered'>
			<div class='modal-content'>
				
				<!-- Modal Header -->
				<div class='modal-header'>
					<h4 class='modal-title'>". $event->getTitle() ."</h4>
				</div>
				
				<!-- Modal body -->
				<div class='modal-body'>
					<p><strong>Posted By: </strong><a href=userprofile.php?UserId=".$event->getUserId().">".$event->getUserId()."</a></p>
					<p><strong>Address: </strong>".$event->getAddress()."</p>
					<p><strong>Category: </strong>".$event->getCategory()."</p>
					<p><strong>Description: </strong>".$event->getDescription()."</p>
					<p><strong>Price: </strong>".$event->getPrice()."</p>
					<p><strong>Age: </strong>".$event->getAgeRestrictions()."</p>
					<p><strong>Date: </strong>".$event->getDateEvent()."</p>
					<p><strong>Rating: </strong>".$event->getRating()."/5 stars</p>

				</div>
				
				<!-- Modal footer -->
				<div class='modal-footer' id='modalfooter".$event->getPostId()."row".$row."'>
					<button type='button' class='btn btn-danger' data-dismiss='modal' onClick='deletePost(".$event->getPostId().")'>🗑️ Delete this Wagwan</button>
					<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
		
			</div>
  		</div>
	</div>
	";
}



?>