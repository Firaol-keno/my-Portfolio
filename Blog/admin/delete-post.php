<?php
  require 'config/database.php';

 if(isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
   // fetch the post from the database that is deleted

   $query = "SELECT * FROM posts WHERE id=$id";
   $result = mysqli_query($conn, $query);

   // make sure only 1 record/post was fetched
     if(mysqli_num_rows($result) == 1) {
      $post = mysqli_fetch_assoc($result);
      $thumbnail_name = $post['thumbnail'];
      $thumbnail_path = '../images/' . $thumbnail_name;

    if($thumbnail_path) {
      unlink($thumbnail_path);
    
    // now delete post from the database
    $delete_post_query = "DELETE FROM posts WHERE id=$id LIMIT 1";
    $delete_post_result = mysqli_query($conn, $delete_post_query);

      if(!mysqli_errno($conn)) {
        $_SESSION['delete-post-success'] = "Post deleted Successfully";
      }
    }

     }
 }

 header('location: ' . ROOT_URL . 'admin/');
  die();
?>