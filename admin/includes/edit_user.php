<?php
    if (isset($_GET['u_id'])) {
        $u_id = $_GET['u_id'];
        $edit_user = "SELECT * FROM `users` WHERE `user_id` = '$u_id' ";
        $edit_user_run = mysqli_query($con, $edit_user);
        while ($user_row=mysqli_fetch_assoc($edit_user_run)) {
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

  <button type="submit" name="updateUser" class="btn btn-primary">Update User</button>
</form>

<?php
  if (isset($_POST['updateUser'])) {
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    // $user_image = $_FILES['post_image']['name'];
    // $post_image_temp = $_FILES['post_image']['tmp_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    
    $update_user = "UPDATE `users` SET `username` = '$username', `user_firstname` = '$user_firstname', `user_lastname` = '$user_lastname', `user_role` = '$user_role', `user_email` = '$user_email', `user_password` = '$user_password'  WHERE `user_id` = '$u_id' ";
    $update_user_run = mysqli_query($con, $update_user);
    if ($update_user_run) {
        header('Location: users.php');
    }
  }
?>