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

                            <div class="col-xs-6">
                            <?php 
                                if (isset($_POST['submit']) && !empty($_POST['cat_title'])) {
                                    $category_title = $_POST['cat_title'];

                                    $insert_cat = "INSERT INTO categories (`cat_title`) VALUES ('$category_title') ";
                                    $insert_cat_run = mysqli_query($con, $insert_cat);
                                }
                            ?>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="cat-title">Add Category</label>
                                        <input type="text" name="cat_title" id="cat-title" class="form-control" placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
                                    </div>
                                </form>

                                <?php 
                                    if (isset($_GET['edit'])) {
                                        $edit_id = $_GET['edit'];
                                        $cat_query = "SELECT * FROM `categories` WHERE `cat_id` = '$edit_id' ";
                                        $cat_query_run = mysqli_query($con, $cat_query);
                                        while ($cat_row = mysqli_fetch_assoc($cat_query_run)) {
                                            $cat_title = $cat_row['cat_title'];
                                            $cat_id = $cat_row['cat_id'];
                                        }
                                        echo "
                                        <div class='well'>
                                            <form action='' method='POST'>
                                                <div class='form-group'>
                                                    <label for='cat-title'>Edit Category</label>

                                                    <input type='text' name='cat_title' id='cat-title' class='form-control' value='$cat_title'>
                                                </div>
                                                <div class='form-group'>
                                                    <input type='submit' name='update' class='btn btn-primary' value='Edit Category'>
                                                </div>
                                            </form>
                                        </div>    
                                        ";
                                        if (isset($_POST['update']) && !empty($_POST['cat_title'])) {
                                            $new_cat_title = $_POST['cat_title'];
                                            $update_category = "UPDATE `categories` SET `cat_title` = '$new_cat_title' WHERE `cat_id` = '$edit_id' ";
                                            $update_category_run = mysqli_query($con, $update_category);
                                            if ($update_category_run) {
                                                header('Location: categories.php');
                                            }
                                        }
                                    }
                                ?>

                            </div>


                            <div class="col-xs-5 col-xs-offset-1">
                                <table class="table table-bordered table-hover">
                                <?php 
                                    $cat_query = "SELECT * FROM `categories` ";
                                    $cat_query_run = mysqli_query($con, $cat_query);
                                ?>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($cat_row = mysqli_fetch_assoc($cat_query_run)) {
                                        $cat_title = $cat_row['cat_title'];
                                        $cat_id = $cat_row['cat_id'];
                                     ?>
                                        <tr>
                                            <td><?php echo $cat_id; ?></td>
                                            <td><?php echo $cat_title; ?> <a href='categories.php?delete=<?php echo $cat_id; ?>' class='pull-right'><i class='fa fa-trash'></i></a> <a href='categories.php?edit=<?php echo $cat_id; ?>' ><i class='fa fa-pencil'></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php 
                                if (isset($_GET['delete'])) {
                                    $delete_id = $_GET['delete'];

                                    $delete_cat = "DELETE FROM `categories` WHERE `cat_id` = '$delete_id' ";
                                    $delete_cat_run = mysqli_query($con, $delete_cat);
                                    if ($delete_cat_run) {
                                        header('Location: categories.php');
                                    }
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