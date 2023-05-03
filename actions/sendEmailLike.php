#!/usr/bin/env php

<?php
if (array_key_exists("email", $_GET)) {
  $email = $_GET['email'];
  $likes = $_GET['likes'];
  $name = "Wagwan";
  $from = "wagwan-DO-NOT-REPLY@gmail.com";
  $message = "Your Wagwan Post has received " . $likes . " likes!";

  $subject = 'Your Post is Popular!';
  $headers = "From: $name <$from>" . "\r\n";
  $body = $message;

  mail($email, $subject, $body, $headers);
}
?>
