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

    $table_name = "test_post";

    // Retrieve the form data
    $what = $_POST['what'];
    $loc = $_POST['where'];
    $details = $_POST['description'];

    // Sanitize the form data to prevent SQL injection
    $what = mysqli_real_escape_string($conn, $what);
    $loc = mysqli_real_escape_string($conn, $loc);
    $details = mysqli_real_escape_string($conn, $details);


    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert the form data into the database
    $sql = "INSERT INTO $table_name (what, loc, details)
          VALUES ('$what', '$loc', '$details')";

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