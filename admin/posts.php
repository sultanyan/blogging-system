<?php include 'includes/admin_header.php'; ?>

    <div id="wrapper">
        <?php include 'includes/admin_navigation.php'; ?>
        
            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Blank Page
                                <small>Subheading</small>
                            </h1>
                        <?php
                            if (isset($_GET['src'])) {
                                    $src = $_GET['src'];
                                }else{
                                    $src = '';
                                }

                                switch ($src) {
                                    case 'add_post':
                                    require 'includes/add_post.php';
                                    break;

                                    case 'edit_post':
                                    require "includes/edit_post.php";
                                    break;
                                    
                                    default:
                                        require 'includes/view_all_posts.php';
                                    break;
                                }
                            
                        ?>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

    

    <?php include 'includes/admin_footer.php'; ?>