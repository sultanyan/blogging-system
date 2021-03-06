<?php require 'includes/db.php'; ?>

<?php include 'includes/header.php' ;?>
<?php include 'includes/navigation.php'; ?>
    
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php 
                    if (isset($_GET['cat_id'])) {
                        $cat_id = $_GET['cat_id'];
                    }
                    $query_post = "SELECT * FROM `posts` WHERE `post_category_id` = '$cat_id' ";
                    $query_post_run = mysqli_query($con, $query_post);

                    while($post_row = mysqli_fetch_assoc($query_post_run)){
                        $post_id = $post_row['post_id'];
                        $title = $post_row['post_title'];
                        $author = $post_row['post_author'];
                        $date = $post_row['post_date'];
                        $content = substr( $post_row['post_content'], 0, 100) . '...';
                        $image = $post_row['post_image'];
                        $post_tags = $post_row['post_tags'];
                ?>        

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $title;; ?></a>
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
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                <?php } ?><!--THIS IS ENDING LOOP 'POST_ROW' CURLEY BRACE-->

            </div><!--div col-md-8 end-->

           
        <?php include 'includes/sidebar.php'; ?>
        </div>
        <!-- /.row -->

        <hr>
<?php include 'includes/footer.php';  ?>

