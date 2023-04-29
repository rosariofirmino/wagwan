#!/usr/local/bin/php
<?php

$config = parse_ini_file("../db_config.ini");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Connect to the database
    $servername = $config["servername"];
    $username = $config["username"];
    $password = $config["password"];
    $dbname = $config["dbname"];

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $table_name = "homepage_posts_test";

    // Retrieve the form data
    $userId = "admin"; // admin is temporary, need to get user ID from session?
    $what = $_POST['what'];
    $loc = $_POST['where'];
    $when = $_POST['when'];
    $category = $_POST['category'];
    $details = $_POST['description'];
    $age = $_POST['age'];
    $price = $_POST['price'];

    // Sanitize the form data to prevent SQL injection
    $what = mysqli_real_escape_string($conn, $what);
    $loc = mysqli_real_escape_string($conn, $loc);
    $details = mysqli_real_escape_string($conn, $details);

    // Convert date to proper MySQL datetime format
    $when = new DateTime($when);
    $when = $when->format('Y-m-d H:i:s');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert the form data into the database
    $sql = "INSERT INTO $table_name(UserId, Address, Title, Description, Price, AgeRestrictions, CategoryId, DateEvent, Rating) 
          VALUES ('$userId', '$loc', '$what', '$details', $price, '$age', '$category','$when', 5)";

    if (mysqli_query($conn, $sql)) {
        echo "Record added successfully";
    } else {
        echo "Error adding record: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);

    // Redirect to the home page
    header("Location: ../index.php");
    exit();
}
?>