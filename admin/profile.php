<?php include 'includes/admin_header.php'; ?>
<div id="wrapper">
    <?php include 'includes/admin_navigation.php'; ?>
    
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                   <?php
                    if (isset($_SESSION['username'])) {
                        $username = $_SESSION['username'];
                        $fetch_user = "SELECT * FROM `users` WHERE `username` = '$username' ";
                        $fetch_user_run = mysqli_query($con, $fetch_user);
                        while ($user_row = mysqli_fetch_array($fetch_user_run)) {
                            $us_name = $user_row['username'];
                            $us_pass = $user_row['user_password'];
                            $us_email = $user_row['user_email'];
                            $us_firstname = $user_row['user_firstname'];
                            $us_lastname = $user_row['user_lastname'];
                            $us_role = $user_row['user_role'];
                        }
                    }
                   ?>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="first-name">Firstname</label>
                            <input type="text" name="user_firstname" class="form-control" id="first-name" value="<?php echo $us_firstname; ?>" required="true">
                        </div>
                        <div class="form-group">
                            <label for="first-name">Lastname</label>
                            <input type="text" name="user_lastname" class="form-control" id="last-name" value="<?php echo $us_lastname; ?>"required="true">
                        </div>
                        <div class="form-group">
                            <label for="user-role">Role</label>
                            <select class="form-control" name="user_role" id="user-role">
                                <option value=""><?php echo $us_role; ?></option>
                                <?php
                                if ($us_role=='admin') {
                                echo "<option value='subscriber'>subscriber</option>";
                                }elseif ($us_role=='subscriber') {
                                echo "<option value='admin'>admin</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user-name">Username</label>
                            <input type="text" name="username" class="form-control" id="user-name" value="<?php echo $us_name; ?>"  required="true">
                        </div>
                        <div class="form-group">
                            <label for="user-email">Email</label>
                            <input type="email" name="user_email" class="form-control" id="user-email" value="<?php echo $us_email; ?>" required="true">
                        </div>
                        <div class="form-group">
                            <label for="user-password">Password</label>
                            <input type="password" name="user_password" class="form-control" id="user-password" value="<?php echo $us_pass; ?>" required="true">
                        </div>
                        <button type="submit" name="updateProfile" class="btn btn-primary">Update Profile</button>
                    </form>

                    <?php
                        if (isset($_POST['updateProfile'])) {
                            $user_firstname = $_POST['user_firstname'];
                            $user_lastname = $_POST['user_lastname'];
                            $user_role = $_POST['user_role'];
                            $username = $_POST['username'];
                            $user_email = $_POST['user_email'];
                            $password = $_POST['password'];

                            $update = "UPDATE `users` SET `user_firstname` = '$user_firstname', `user_lastname` = '$user_lastname', `user_email` = '$user_email', `user_role` = '$user_role', `user_password` = '$user_password' WHERE `username` = '$username' ";
                            $update_run = mysqli_query($con, $update);
                            if ($update_run) {
                                header('Location: users.php');
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