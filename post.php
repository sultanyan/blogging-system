<?php require 'includes/db.php'; ?>

<?php include 'includes/header.php' ;?>
<?php include 'includes/navigation.php'; ?>
    
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

        <?php
            if (isset($_GET['p_id'])) {
                $p_id = $_GET['p_id'];
                $view_posts = "UPDATE `posts` SET `post_views_count` = `post_views_count` +1 WHERE `post_id` = '$p_id' ";
                $view_posts_run = mysqli_query($con, $view_posts);
        ?>
                
                <?php 
                    $query_post = "SELECT * FROM `posts` WHERE `post_id` = '$p_id' ";
                    $query_post_run = mysqli_query($con, $query_post);

                    while($post_row = mysqli_fetch_assoc($query_post_run)){
                        $post_id = $post_row['post_id'];
                        $title = $post_row['post_title'];
                        $author = $post_row['post_author'];
                        $date = $post_row['post_date'];
                        $content = $post_row['post_content'];
                        $image = $post_row['post_image'];
                        $post_tags = $post_row['post_tags'];
                ?>        

                <!-- First Blog Post -->
                <h2>
                   <p class='heading heading-primary'> <?php echo $title; ?></p>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
                <hr>
                <img class="img-responsive" id="imageMain" src="images/<?php echo $image; ?>" alt="sharpen">
                <hr>
                <p><?php echo $content; ?></p>
                <p> Tags: <i> <?php echo $post_tags; ?> </i> </p>
                <hr>
                <?php } 


                }else{
                    header('Location: index.php');
                }

                ?><!--THIS IS ENDING LOOP 'POST_ROW' CURLEY BRACE-->

                 <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="POST">
                        
                         <div class="form-group">
                            <label for="comment-author">Your Name</label>
                             <input type="text" name="comment_author" class="form-control" id="comment-author" placeholder="Name">
                         </div>

                         <div class="form-group">
                            <label for="comment-author-email">Your Email</label>
                             <input type="email" name="comment_author_email" class="form-control" id="comment-author-email" placeholder="Email">
                         </div>

                        <div class="form-group">
                            <label for="comment-content">Your Comment</label>
                            <textarea class="form-control" rows="3" id="comment-content" name="comment_content" placeholder="Comment"></textarea>
                        </div>
                        <button type="submit" name="createComment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            <?php
                if (isset($_POST['createComment'])) {
                    $p_id = $_GET['p_id'];
                    $name = $_POST['comment_author'];
                    $email = $_POST['comment_author_email'];
                    $comment = $_POST['comment_content'];

                 if (!empty($name) && !empty($email) && !empty($comment)) {
                    $insert_comment = "INSERT INTO `comments` (`comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES ('$p_id', '$name', '$email', '$comment', 'unapproved', NOW() )";
                    $insert_comment_run = mysqli_query($con, $insert_comment);


                    $update_count = "UPDATE `posts` SET `post_comment_count` = post_comment_count+1 WHERE `post_id` = '$p_id' ";
                    $update_count_run = mysqli_query($con, $update_count);
                 }else {
                     echo "<script>alert('Please fill in all fields')</script>";
                 }
                }
            ?>



                <hr>

                <!-- Posted Comments -->
                <?php 
                $comments = "SELECT * FROM `comments` ";
                $comments_run = mysqli_query($con, $comments);

                while ($comments_row=mysqli_fetch_assoc($comments_run)) {
                    $comment_id = $comments_row['comment_id'];
                 }
                    $comment = "SELECT * FROM `comments` WHERE `comment_post_id` = '$post_id' AND `comment_status` = 'approved' ORDER BY `comment_id` DESC ";
                    $comment_run = mysqli_query($con, $comment);
                    while ($comment_row = mysqli_fetch_assoc($comment_run)) {
                        $author = $comment_row['comment_author'];
                        $date = $comment_row['comment_date'];
                        $content = $comment_row['comment_content'];
                    
                ?>
                <!-- Comment -->
                <div class="media panel">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $author; ?>
                            <small><?php echo $date; ?></small>
                        </h4>
                        <?php echo $content; ?>
                    </div>
                </div>
                <?php } ?>

            </div><!--div col-md-8 end-->

           
        <?php include 'includes/sidebar.php'; ?>
        </div>
        <!-- /.row -->

        <hr>
<?php include 'includes/footer.php';  ?>

