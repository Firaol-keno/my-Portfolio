<?php

require 'config/database.php';

//get signup form data if signup button was clicked
 if(isset($_POST['submit'])) {
  $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
  $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);   
  $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
  $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
  $avatar = $_FILES['avatar'];

  //validate input values
 
  if(!$firstname) {
    $_SESSION['signup'] = "please enter your name";
  } elseif(!$lastname) {
    $_SESSION['signup'] = "please enter your name";
  } elseif(!$username) {
    $_SESSION['signup'] = "please enter your name";
  } elseif(!$email) {
    $_SESSION['signup'] = "please enter your valid email";
  } elseif(strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
    $_SESSION['signup'] = "password should be 8+ character";
  } elseif(!$avatar['name']) {
    $_SESSION['signup'] = "please add an avatar";
  } else {
    // check if passwords don't match
    if($createpassword !== $confirmpassword) {
      $_SESSION['signup'] = "passwords do not match";
    } else {
      // hash password
      $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);
      // check if username or email already exists in database
       
      $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
      $user_check_result = mysqli_query($conn, $user_check_query);
       if(mysqli_num_rows($user_check_result) > 0) {
        $_SESSION['signup'] = "username or email already exists";
       } else {
        // work on avatar
        // rename avatar
        $time = time(); // make each image name unique using current timestamp
        $avatar_name = $time.$avatar['name'];
        $avatar_tmp_name = $avatar['tmp_name'];
        $avatar_destination_path = 'images/' . $avatar_name;

    //make sure file is an image
    $allowed_files = ['png', 'jpg', 'jpeg'];
    $extension = explode('.', $avatar_name);
    $extension = end($extension);

      if(in_array($extension, $allowed_files)) {
        // make sure image size is not large (1mb+)
          if($avatar['size'] < 1000000) {
              //upload avatar
              move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
          } else {
              $_SESSION['signup'] = "File size too big. Should be less than 1Mb.";
          }
      } else{
        $_SESSION['signup'] = "File Should be png, jpg, or jpeg";
      }

       }
    }
  }

   // redirect back to signup page if there is was any problem

   if(isset($_SESSION['signup'])) {
      // pass form data back to signup page
 $_SESSION['signup-data'] = $_POST;

    header('location: '. ROOT_URL . 'signup.php');
    die();
   } else {
    // insert new user into users table
    $insert_user_query = "INSERT INTO users SET firstname='$firstname', lastname='$lastname', username='$username',
     email='$email', password='$hashed_password', avatar='$avatar_name', is_admin=0";
          

    $insert_user_result = mysqli_query($conn, $insert_user_query);

          if(!mysqli_errno($conn)) {
            //redirect to login page with success message
            $_SESSION['signup-success'] = "Registeration Successfil, please log in";
            header('location: ' . ROOT_URL . 'signin.php');
            die();
          }
   }

  } else {
      // if button wasn't clicked, bounce back to signup page 

      header('location: '. ROOT_URL . 'signup.php');
      die();
  }


?>