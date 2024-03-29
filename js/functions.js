function likeButtonPress(Row, PostId, Likes, UserLiked) {
    if (isLoggedIn == false) { // check if logged in
        window.location.href = "php/login.php"; //redirect to login page
        return 0;
    }
    else if(UserLiked == true && isLoggedIn == true) { // unlike
        var audio = new Audio('sound/dislike.mp3');
        audio.volume = 0.5;
        audio.play();

        // set icon to unlike
        $("#path" + Row + "" + PostId).attr("d", "m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z");
        
        // set like count to likes - 1
        $("#" + Row + "likes" + PostId).html("&nbsp; " + (Likes - 1) + "");
    
        // change button onclick
        $("#button"+ Row + "" + PostId).attr("onClick","likeButtonPress(" + Row + ", " + PostId + ", " + (Likes - 1) + ", " + !UserLiked + ")");
    }
    else if (isLoggedIn == true){ // like
        var audio = new Audio('sound/like.mp3');
        audio.volume = 0.5;
        audio.play();

        // set icon to like4
        $("#path" + Row + "" + PostId).attr("d", "M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z");
        
        // set like count to likes - 1
        $("#" + Row + "likes" + PostId).html("&nbsp; " + (Likes + 1) + "");
    
        // change button onclick
        $("#button"+ Row + "" + PostId).attr("onClick","likeButtonPress(" + Row + ", " + PostId + ", " + (Likes + 1) + ", " + !UserLiked + ")");
    }
    
    
    // AJAX for like update / update like in database
    
    // get UserId from session in 'id'
    
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        id = id; // preserve across AJAX
    }
    
    if (UserLiked == true) { // unlike
        xhttp.open("GET", "actions/dislike.php?PostId=" + PostId + "&UserId=" + id, true);
    }
    if (UserLiked == false) { // like
        xhttp.open("GET", "actions/like.php?PostId=" + PostId + "&UserId=" + id + "&Likes=" + Likes, true);
    }
    
    xhttp.send();
}

function deletePost(PostId) {
	// AJAX for deletion in database

	// get UserId
	var UserId = id; // get UserId from session
    console.log(id)

	const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        id = id; // preserve across AJAX
    }
	xhttp.open("GET", "actions/deletePost.php?PostId=" + PostId + "&UserId=" + UserId, true);
	xhttp.send();

	// reload page to remove deleted post from page
	setTimeout(function(){ // reloads after 0.5 seconds
		location.reload();
	}, 500);
}

function rating(PostId, Rating, Row) {

    if (isLoggedIn == false) { // check if logged in
        window.location.href = "php/login.php"; // redirect to login page
        return 0;
    }

    // play sound
    var audio = new Audio('sound/rate.mp3');
    audio.volume = 0.4;
    audio.play();

    // AJAX for rating update / update rating in database
    var UserId = id; // get UserId from session
    console.log(id);
    // add rating entry
    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", "actions/addUserRating.php?PostId=" + PostId + "&UserId=" + UserId + "&Rating=" + Rating, true);
    xhttp.send();

    // update total rating of post
    setTimeout(function(){ // waits 0.5 seconds to prevent executing before entry was added
        const xhttp2 = new XMLHttpRequest();
		xhttp2.onload = function() {
            obj = JSON.parse(this.responseText);
            console.log(obj.rating);

            for (var i = 1; i <= 5; i++) {
                var radio = document.querySelector('#star'+ i + PostId + obj.row);
                if (radio.checked) {
                    radio.removeAttribute('checked');
                    radio.focus();
                }
            }

            for (var i = 1; i <= 5; i++) {
                radio = document.querySelector('#star'+ i + PostId + obj.row);
                if (i == obj.rating || (i + 1 > obj.rating) && (i < obj.rating)) {
                    radio.setAttribute('checked', true);
                    radio.focus();
                    var label = document.querySelector('#stars' + PostId + obj.row);
                    label.textContent = "" + obj.rating + " / 5 stars";
                }
            }

          }
       
        xhttp2.open("GET", "actions/calculateRating.php?PostId=" + PostId + "&Row=" + Row, true);
        xhttp2.send();
	}, 500);
}

function quickSearch() { // redirect to search with search bar value

    // check if logged in
    if (isLoggedIn == false) {
        window.location.href = "php/login.php"; // redirect to login page
        return 0;
    }


    // get value of search bar (id = quick)
    var search = document.getElementById("quick").value;
    console.log(search);
    window.location.href = "search.php?text="+search+"&category=any&price=any&age=any"; // redirect to search page with search bar value
}

