<?php
// prints a Event object to a card with php
// Usage: include_once("postprinter.php");

function printEvent($event, $row) {
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
				<div class='modal-footer'>
					<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
		
			</div>
  		</div>
	</div>
	";
}



?>