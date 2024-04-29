<?php
require 'constants.php';

// connection with a database


$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


  if(mysqli_error($conn)) {
    die(mysqli_error($conn));
  }
?>