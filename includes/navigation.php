<?php session_start(); ?>
<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                <li> <a href="admin/index.php">Admin</a></li>
                <!-- <li><a href="registration.php">Sign Up</a></li> -->
                <?php
                    $query = "SELECT * FROM `categories` ";
                    $query_run_categories_all = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($query_run_categories_all)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='category.php?cat_id=$cat_id'>{$cat_title}</a></li>";
                    }
                ?>
            <?php
                if (isset($_SESSION['user_role'])) {
                        if ($_SESSION['user_role'] == 'admin') {
                             if (isset($_GET['p_id'])) {
                            $post_id = $_GET['p_id'];
                            echo "<li><a href='admin/posts.php?src=edit_post&p_id=$post_id'>Edit Post</a></li>";
                        }
                    }
                }
            ?>
            </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
