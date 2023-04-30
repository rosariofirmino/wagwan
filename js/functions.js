function likeButtonPress(Row, PostId, Likes, UserLiked) {

    if(UserLiked == true) { // unlike
        // set icon to unlike
        $("#" + Row + "path" + PostId).attr("d", "m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z");
        
        // set like count to likes - 1
        $("#" + Row + "likes" + PostId).html("&nbsp; " + (Likes - 1) + "");
    
        // change button onclick
        $("#button"+ Row + "" + PostId).attr("onClick","likeButtonPress(" + Row + ", " + PostId + ", " + (Likes - 1) + ", " + !UserLiked + ")");
    }
    else { // like
        // set icon to like4
        $("#" + Row + "path" + PostId).attr("d", "M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z");
        
        // set like count to likes - 1
        $("#" + Row + "likes" + PostId).html("&nbsp; " + (Likes + 1) + "");
    
        // change button onclick
        $("#button"+ Row + "" + PostId).attr("onClick","likeButtonPress(" + Row + ", " + PostId + ", " + (Likes + 1) + ", " + !UserLiked + ")");
    }
    
    
    // AJAX for like update / update like in database
    
    // get UserId
    var UserId = "admin"; // TODO: get UserId from session
    
    const xhttp = new XMLHttpRequest();
    
    if (UserLiked == true) { // unlike
        xhttp.open("GET", "actions/dislike.php?PostId=" + PostId + "&UserId=" + UserId, true);
    }
    if (UserLiked == false) { // like
        xhttp.open("GET", "actions/like.php?PostId=" + PostId + "&UserId=" + UserId, true);
    }
    
    xhttp.send();
}

function deletePost(PostId) {
	// AJAX for deletion in database

	// get UserId
	var UserId = "admin"; // TODO: get UserId from session

	const xhttp = new XMLHttpRequest();
	xhttp.open("GET", "actions/deletePost.php?PostId=" + PostId + "&UserId=" + UserId, true);
	xhttp.send();

	// reload page to remove deleted post from page
	setTimeout(function(){ // reloads after 0.5 seconds
		location.reload();
	}, 500);
}