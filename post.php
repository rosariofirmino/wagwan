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

</head>


<body style="background-color: black; color: white;">

    <h1 class="welcome-header">Welcome to Wagwan</h1>
    <p class="guide-desc">Your guide for local things to do</p>

    <div class="container">
        <div class="card post-card">
            <div class="card-header text-center">
                <h4 class="card-title">Wagwan?</h4>
                <button type="button" class="close" aria-label="Close" onclick="window.location.href='./'">
                    <span aria-hidden="true" class="text-light">&times;</span>
                </button>
            </div>
            <form action="actions/submitPost.php" method="POST">
                <div class="card-body">
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
                            <option value="nightlife">nightlife</option>
                            <option value="market">market</option>
                            <option value="concert">concert</option>
                            <option value="food">food</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="8" required></textarea>
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
                        <label for="price">Price</label>
                        $ <input type="range" id="price" name="price"> $$$
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
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