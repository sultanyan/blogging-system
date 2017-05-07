<?php require 'includes/db.php'; ?>

<?php include 'includes/header.php' ;?>
<?php include 'includes/navigation.php'; ?>
    
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php 
                    if (isset($_POST['submit'])) {
                        $search = $_POST['search'];

                        $search_query = "SELECT * FROM `posts` WHERE `post_tags` LIKE '%$search%' ";
                        $search_query_run = mysqli_query($con, $search_query);

                        $count = mysqli_num_rows($search_query_run);
                        if ($count==0) {
                            echo "<div class='alert alert-danger search-alert'><h3>Sorry, no results found.</h3></div>";
                        }else{
                            while($post_row = mysqli_fetch_assoc($search_query_run)){
                            $title = $post_row['post_title'];
                            $author = $post_row['post_author'];
                            $date = $post_row['post_date'];
                            $content = $post_row['post_content'];
                            $image = $post_row['post_image'];
                            $post_tags = $post_row['post_tags'];
                        ?>        

                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $title;; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $image; ?>" alt="sharpen">
                        <hr>
                        <p><?php echo $content; ?></p>
                        <p> Tags: <i> <?php echo $post_tags; ?> </i> </p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <hr>

                    <?php

                        }//<!--THIS IS ENDING loop's CURLEY BRACE-->

                    } //<!--THIS IS ENDING else's CURLEY BRACE-->

                 } ?><!--THIS IS ENDING if isset submit's CURLEY BRACE-->

            </div><!--div col-md-8 end-->

           
        <?php include 'includes/sidebar.php'; ?>
        </div>
        <!-- /.row -->

        <hr>
<?php include 'includes/footer.php';  ?>

    