<?php include 'includes/admin_header.php'; ?>
    <div id="wrapper">
        <?php include 'includes/admin_navigation.php'; ?>
        
            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Welcome to admin
                                <small><?php echo $_SESSION['username']; ?></small>
                            </h1>
                        </div>
                    </div>
                    <!-- /.row -->

                    <!-- WIDGETS START -->
                        <div class="row">
                            <div class="col-lg-3 col-sm-3">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-file-text fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php 
                                                $posts = "SELECT * FROM `posts` WHERE `post_status` = 'published' ";
                                                $posts_run = mysqli_query($con, $posts);
                                                $count_posts = mysqli_num_rows($posts_run);
                                            ?>
                                                <div class="huge"><?php echo $count_posts; ?></div>
                                                <div>Published Posts</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="posts.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-3">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-comments fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php 
                                                $coms = "SELECT * FROM `comments` ";
                                                $coms_run = mysqli_query($con, $coms);
                                                $count_coms = mysqli_num_rows($coms_run);
                                            ?>
                                                <div class="huge"><?php echo $count_coms; ?></div>
                                                <div>Comments</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="comments.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>


                            <div class="col-lg-3 col-sm-3">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-users fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php 
                                                $users = "SELECT * FROM `users` ";
                                                $users_run = mysqli_query($con, $users);
                                                $count_users = mysqli_num_rows($users_run);
                                            ?>
                                                <div class="huge"><?php echo $count_users; ?></div>
                                                <div>Users</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="users.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>


                            <div class="col-lg-3 col-sm-3">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-list fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php 
                                                $cats = "SELECT * FROM `categories` ";
                                                $cats_run = mysqli_query($con, $cats);
                                                $count_cats = mysqli_num_rows($cats_run);
                                            ?>
                                                <div class="huge"><?php echo $count_cats; ?></div>
                                                <div>Categories</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="categories.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>
                    <!-- WIDGETS END -->

                    <?php 
                        $posts_draft = "SELECT * FROM `posts` WHERE `post_status` = 'draft' ";
                        $draft_posts_run = mysqli_query($con, $posts_draft);
                        $count_draft_posts = mysqli_num_rows($draft_posts_run);

                        $all_posts = "SELECT * FROM `posts` ";
                        $all_posts_run = mysqli_query($con, $all_posts);
                        $count_all_posts = mysqli_num_rows($all_posts_run);

                        $unapproved_comments = "SELECT * FROM `comments` WHERE `comment_status` = 'unapproved' ";
                        $unapproved_comments_run = mysqli_query($con, $unapproved_comments);
                        $unapproved_comments_count = mysqli_num_rows($unapproved_comments_run);

                        $subs = "SELECT * FROM `users` WHERE `user_role` = 'subscriber' ";
                        $subs_run = mysqli_query($con, $subs);
                        $subs_count = mysqli_num_rows($subs_run);
                    ?>

                    <div class="row">
                       
                        <script type="text/javascript">
                          google.charts.load('current', {'packages':['bar']});
                          google.charts.setOnLoadCallback(drawChart);
                          function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                              ['Year', 'Count'],

                            <?php
                                $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                                $element_count = [$count_all_posts, $count_posts, $count_draft_posts, $count_coms, $unapproved_comments_count, $count_users, $subs_count, $count_cats];

                                for ($i = 0; $i<8; $i++) {
                                    echo "['{$element_text[$i]}'" . " ," . "{$element_count[$i]}]," ;
                                }
                            ?>
                            ]);

                            var options = {
                              chart: {
                                title: '',
                                subtitle: '',
                              }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, options);
                          }
                        </script>
                     <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

    

    <?php include 'includes/admin_footer.php'; ?>