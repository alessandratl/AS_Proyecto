<?php

  $hostname = "db";
  $username = "admin";
  $password = "xcOP37L3";
  $db = "Agenda";

  $conn = mysqli_connect($hostname,$username,$password,$db);
  if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
  }


?>
