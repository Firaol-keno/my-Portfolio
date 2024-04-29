<?php

include 'partials/header.php';

// fetch post from database if id is set

 if(isset($_GET['id'])) {
   $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
   $query = "SELECT * FROM posts WHERE id=$id";
   $result = mysqli_query($conn, $query);
   $post = mysqli_fetch_assoc($result);
 } else {
   header('location: ' . ROOT_URL . 'blog.php');
   die();
 }

?>

    <section class="singlepost">
        <div class="container singlepost__container">
            <h2><?= $post['title']?></h2>
            <div class="post__author">
              <div class="post__author-avatar">
              <?php
               //fetch author from users tables using author_id
               $author_id = $post['author_id'];
               $author_query = "SELECT * FROM users WHERE id=$author_id";
               $author_result = mysqli_query($conn, $author_query);
               $author = mysqli_fetch_assoc($author_result);
            ?>
                <img src="./images/<?= $author['avatar']?>" />
              </div>
              <div class="post__author-info">
                <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                <small>
                <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                </small>
              </div>
            </div>
          <div class="singlepost__thumbnail">
          <img src="./images/<?= $post['thumbnail']?>" />
          </div>
          <p class="single-post-body"><?= $post['body'] ?></p>
        </div>
    </section>
   
   <!--========================  End of single post =====================-->
   <?php
    include 'partials/footer.php';
    ?>
  
    