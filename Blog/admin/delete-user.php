<?php
  require 'config/database.php';

  if(isset($_GET['id'])) {
    // fetch user from the database
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    
    // fetch user from database
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    // make sure we got only one user

    if(mysqli_num_rows($result) == 1) {
      $avatar_name = $user['avatar'];
      $avatar_path = '../images/' . $avatar_name;
    // delete the image that is stored  inside the images folder
    // which is stored during registration
    if($avatar_path) {
      unlink($avatar_path);
    }
    }

    // fro later
    // fetch all thumnail of user's posts and delete them

    $thumbnail_query = "SELECT thumbnail FROM posts WHERE author_id=$id";
    $thumbnail_result = mysqli_query($conn, $thumbnail_query);
      if(mysqli_num_rows($thumbnail_result) > 0) {
          while($thumbnail = mysqli_fetch_assoc($thumbnail_result)) {
              $thumbnail_path = '../images/' . $thumbnail['thumbnail'];
          // delete thumbnail from images folder if exists
           if($thumbnail_path) {
               unlink($thumbnail_path);
           }
          }
      }



    //delete user from database
    $delete_user_query = "DELETE FROM users WHERE id=$id";
    $delete_user_result = mysqli_query($conn, $delete_user_query);

    if(mysqli_errno($conn)) {
      $_SESSION['delete-user'] = "Could not {$user['firstname']} {$user['$lastname']}";
    } else {
       $_SESSION['delete-user-success'] = "{$user['firstname']} {$user['$lastname']} deleted successfully";
    }
  }

  header('location: ' . ROOT_URL . 'admin/manage-users.php');
?>