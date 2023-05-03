#!/usr/local/bin/php

<?php

session_start();

// Check if the user is already logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ./php/login.php");
    exit;
}

?>

<html>

<head>
    <title>Wagwan Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</head>


<body style="background-color: #2D283E ; color:#D1D7E0 ;">

    <h1 class="welcome-header">Welcome to Wagwan</h1>
    <p class="guide-desc">Your guide for local things to do</p>

    <div class="container">
        <div class="card post-card">
            <div class="card-header text-center" style="background-color: #393748;">
                <h4 class="card-title">Wagwan?</h4>
                <button type="button" class="close" aria-label="Close" onclick="window.location.href='./'">
                    <span aria-hidden="true" class="text-light">&times;</span>
                </button>
            </div>
            <form action="actions/submitPost.php" style="background-color: #4C495D;" method="POST">
                <div class="card-body" style="background-color: #4C495D;">
                    <div class="form-group">
                        <label for="what">What?</label>
                        <input type="text" class="form-control" id="what" name="what" required>
                    </div>
                    <div class="form-group">
                        <label for="where">Where?</label>
                        <input type="text" class="form-control" id="where" name="where" required>
                    </div>
                    <div class="form-group">
                        <label for="when">When?</label>
                        <input id="when" type="datetime-local" name="when" min="<?php echo date("Y-m-d H:i"); ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category?</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="nightlife">Nightlife</option>
                            <option value="shop">Shop</option>
                            <option value="performances">Performance</option>
                            <option value="food">Food</option>
                            <option value="activity">Activity</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="age">Age?</label>
                        <select class="form-control" id="age" name="age" required>
                            <option value="All Ages">All Ages</option>
                            <option value="18+">18+</option>
                            <option value="21+">21+</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="age">Price?</label>
                        <div class="price-container">
                            <input label="🆓" type="radio" name="price" value="0" style="margin-right: 90px">
                            <input label="💸" type="radio" name="price" value="1" style="margin-right: 90px" checked
                                required>
                            <input label="💰" type="radio" name="price" value="2" style="margin-right: 90px">
                            <input label="💎" type="radio" name="price" value="3" style="margin-right: 90px">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <div class="image-container">
                            <input type="radio" id="club1" name="image" value="club1" onclick="test()" checked>
                            <label for="club1">
                                <img src="posts_images/club1.jpeg" alt="club1">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="club2" name="image" value="club2">
                            <label for="club2">
                                <img src="posts_images/club2.jpeg" alt="club2">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="restaurant1" name="image" value="restaurant1">
                            <label for="restaurant1">
                                <img src="posts_images/restaurant1.jpeg" alt="restaurant1">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="restaurant2" name="image" value="restaurant2">
                            <label for="restaurant2">
                                <img src="posts_images/restaurant2.jpeg" alt="restaurant2">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="karaoke" name="image" value="karaoke">
                            <label for="karaoke">
                                <img src="posts_images/karaoke.jpeg" alt="karaoke">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="market1" name="image" value="market1">
                            <label for="market1">
                                <img src="posts_images/market1.jpeg" alt="market1">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="market2" name="image" value="market2">
                            <label for="market2">
                                <img src="posts_images/market2.jpeg" alt="market2">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="market3" name="image" value="market3">
                            <label for="market3">
                                <img src="posts_images/market3.jpeg" alt="market3">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="coffee1" name="image" value="coffee1">
                            <label for="coffee1">
                                <img src="posts_images/coffee1.jpeg" alt="coffee1">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="coffee2" name="image" value="coffee2">
                            <label for="coffee2">
                                <img src="posts_images/coffee2.jpeg" alt="coffee2">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="bakery" name="image" value="bakery">
                            <label for="bakery">
                                <img src="posts_images/bakery.jpeg" alt="bakery">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="sweets" name="image" value="sweets">
                            <label for="sweets">
                                <img src="posts_images/sweets.jpeg" alt="sweets">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="museum" name="image" value="museum">
                            <label for="museum">
                                <img src="posts_images/museum.jpeg" alt="museum">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="icecream" name="image" value="icecream">
                            <label for="icecream">
                                <img src="posts_images/icecream.jpeg" alt="icecream">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="bar" name="image" value="bar">
                            <label for="bar">
                                <img src="posts_images/bar.jpeg" alt="bar">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="movie" name="image" value="movie">
                            <label for="movie">
                                <img src="posts_images/movie.jpeg" alt="movie">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="football" name="image" value="football">
                            <label for="football">
                                <img src="posts_images/football.jpeg" alt="football">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="tailgate" name="image" value="tailgate">
                            <label for="tailgate">
                                <img src="posts_images/tailgate.jpeg" alt="tailgate">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="basketball" name="image" value="basketball">
                            <label for="basketball">
                                <img src="posts_images/basketball.jpeg" alt="basketball">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="soccer" name="image" value="soccer">
                            <label for="soccer">
                                <img src="posts_images/soccer.jpeg" alt="soccer">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="baseball" name="image" value="baseball">
                            <label for="baseball">
                                <img src="posts_images/baseball.jpeg" alt="baseball">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="beach" name="image" value="beach">
                            <label for="beach">
                                <img src="posts_images/beach.jpeg" alt="beach">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="pool" name="image" value="pool">
                            <label for="pool">
                                <img src="posts_images/pool.jpeg" alt="pool">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="dancing" name="image" value="dancing">
                            <label for="dancing">
                                <img src="posts_images/dancing.jpeg" alt="dancing">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="picnic" name="image" value="picnic">
                            <label for="picnic">
                                <img src="posts_images/picnic.jpeg" alt="picnic">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="game" name="image" value="game">
                            <label for="game">
                                <img src="posts_images/game.jpeg" alt="game">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="club" name="image" value="club">
                            <label for="club">
                                <img src="posts_images/club.jpeg" alt="club">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="speaker" name="image" value="speaker">
                            <label for="speaker">
                                <img src="posts_images/speaker.jpeg" alt="speaker">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="election" name="image" value="election">
                            <label for="election">
                                <img src="posts_images/election.jpeg" alt="election">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="record" name="image" value="record">
                            <label for="record">
                                <img src="posts_images/record.jpeg" alt="record">
                            </label>
                        </div>
                        <div class="image-container">
                            <input type="radio" id="skating" name="image" value="skating">
                            <label for="skating">
                                <img src="posts_images/skating.jpeg" alt="skating">
                            </label>
                        </div>

                    </div>
                    
                        <button style="background-color: #802BB1; border:0px;"type="submit" class="btn btn-primary float-right">Submit</button>
                   
            </form>
        </div>


    </div>


    <script>
        const postCard = document.querySelector('.post-card');

        window.onload = function () {
            setTimeout(function () {
                postCard.classList.add('show');
            }, 300);
        }
    </script>

</body>

</html>