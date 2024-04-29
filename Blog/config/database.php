<?php
require 'config/constants.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if(mysqli_error($conn)) {
    die(mysqli_error($conn));
  }
?>