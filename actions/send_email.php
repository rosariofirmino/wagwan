#!/usr/bin/env php

<?php
if (array_key_exists("email", $_GET)) {
  $email = $_GET['email'];

  $name = "Wagwan";
  $from = "wagwan-DO-NOT-REPLY@gmail.com";
  $message = "Welcome to Wagwan!\n\nThis email is to confirm that you have created an account with us. Enjoy!";

  $subject = 'Welcome to Wagwan!';
  $headers = "From: $name <$from>" . "\r\n";
  $body = $message;

  mail($email, $subject, $body, $headers);
  header("location: ../index.php");
}
?>
