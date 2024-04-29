<?php

require 'config/database.php';

//fetch current user from database
if(isset($_SESSION['user-id'])) {
  $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT avatar FROM users WHERE id=$id";
  $result = mysqli_query($conn, $query);
  $avatar  = mysqli_fetch_assoc($result);
 }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Multipage Blog Website</title>
    <!-- CUSTOM STYLESHEET -->
    

    <link rel="stylesheet" href="<?php echo ROOT_URL ?>css/style.css"/>
    <!--<link rel="stylesheet" href="<?php echo ROOT_URL ?>../css/style.css"/> use this also worked  -->


    <!-- ICONSCOUT CDN -->
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
    <!-- GOOGLE FONT (MONTSERRAT) -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <nav>
      <div class="container nav__container">
        <a href="index.php" class="nav__logo">BLOG</a>
        <ul class="nav__items">
          <li><a href="<?php echo ROOT_URL ?>blog.php">Home</a></li>
          <li><a href="<?php echo ROOT_URL ?>about.php">About</a></li>
          <li><a href="<?php echo ROOT_URL ?>services.php">Services</a></li>
          <li><a href="<?php echo ROOT_URL ?>contact.php">Contact</a></li>
          <?php if(isset($_SESSION['user-id'])):?>
            <li class="nav__profile">
            <div class="avatar">
            <img src="<?= ROOT_URL . 'images/' .$avatar['avatar'] ?>" />
            </div>
            <ul>
              <li><a href="<?php echo ROOT_URL ?>admin/index.php">Dashboard</a></li>
              <li><a href="<?php echo ROOT_URL ?>logout.php">Logout</a></li>
            </ul>
           </li>
           <?php else : ?>
          <li><a href="<?php echo ROOT_URL ?>Signin.php">Signin</a></li>
          <?php endif ?>      
        </ul>
        <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
        <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
      </div>
    </nav>
    <!-- ======================  END OF NAV  ==================== -->
