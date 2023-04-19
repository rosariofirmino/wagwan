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
<?php

?>

<body style="background-color: black; color: white;">

    <h1 class="welcome-header">Welcome to Wagwan</h1>
    <p class="guide-desc">Your guide for local things to do</p>

    <div class="container">
        <div class="card post-card">
            <div class="card-header text-center">
                <h4 class="card-title">Wagwan?</h4>
                <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true" class="text-light">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="what">What?</label>
                    <input type="text" class="form-control" id="what">
                </div>
                <div class="form-group">
                    <label for="where">Where?</label>
                    <input type="text" class="form-control" id="where">
                </div>
                <div class="form-group">
                    <label for="when">When?</label>
                    <input type="text" class="form-control" id="when">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="8"></textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary float-right">Submit</button>
            </div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.close').click(function () {
                $('.card').hide();
            });
        });
    </script>

</body>

</html>