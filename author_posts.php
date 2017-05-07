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
                        $author = $_GET['author'];
                    }
                ?>
                
                <?php 
                    $query_post = "SELECT * FROM `posts` WHERE `post_author` = '$author' ";
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
                <img class="img-responsive" id="imageMain" src="images/<?php echo $image; ?>">
                <hr>
                <p><?php echo $content; ?></p>
                <p> Tags: <i> <?php echo $post_tags; ?> </i> </p>
                <hr>
                <?php } ?><!--THIS IS ENDING LOOP 'POST_ROW' CURLEY BRACE-->            
                <hr>
            </div><!--div col-md-8 end-->

           
        <?php include 'includes/sidebar.php'; ?>
        </div>
        <!-- /.row -->

        <hr>
<?php include 'includes/footer.php';  ?>

