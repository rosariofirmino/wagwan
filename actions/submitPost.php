#!/usr/local/bin/php
<?php

session_start();

// Check if the user is already logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ./php/login.php");
    exit;
}

$config = parse_ini_file("../db_config.ini");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Connect to the database
    $servername = $config["servername"];
    $username = $config["username"];
    $password = $config["password"];
    $dbname = $config["dbname"];

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $table_name = "dev_posts";

    // Retrieve the form data
    $userId = $_SESSION["id"];
    $what = $_POST['what'];
    $loc = $_POST['where'];
    $when = $_POST['when'];
    $category = $_POST['category'];
    $details = $_POST['description'];
    $age = $_POST['age'];
    $price = $_POST['price'];
    $image = $_POST['image'];

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
    $sql = "INSERT INTO $table_name(UserId, Address, Title, Description, Price, AgeRestrictions, CategoryId, DateEvent, Rating, ImageId) 
          VALUES ('$userId', '$loc', '$what', '$details', $price, '$age', '$category','$when', 5, '$image')";

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