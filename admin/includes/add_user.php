<?php
	if (isset($_POST['createUser'])) {
		$username = $_POST['username'];
		$user_firstname = $_POST['user_firstname'];
		$user_lastname = $_POST['user_lastname'];
		$user_role = $_POST['user_role'];
		// $user_image = $_FILES['post_image']['name'];
		// $post_image_temp = $_FILES['post_image']['tmp_name'];
		$user_email = $_POST['user_email'];
		$user_password = $_POST['user_password'];
		$user_reg_date = date('d-m-y');
		// $post_comment_count = 4;

		// move_uploaded_file($post_image_temp, "../images/$post_image");

		$insert_user = "INSERT INTO users (`username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_role`, `user_reg_date`) VALUES ('$username', '$user_password', '$user_firstname',  '$user_lastname', '$user_email', '$user_role', NOW() ) ";
		$insert_user_run = mysqli_query($con, $insert_user);
		if ($insert_user_run) {
			header('Location: users.php');
		}else{
      echo "something went wrong" . mysqli_error($con);
    }
	}
?>
<form method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label for="first-name">Firstname</label>
    <input type="text" name="user_firstname" class="form-control" id="first-name" placeholder="Firstname" required="true">
  </div>

  <div class="form-group">
    <label for="first-name">Lastname</label>
    <input type="text" name="user_lastname" class="form-control" id="last-name" placeholder="Lastname" required="true">
  </div>


  <div class="form-group">
    <label for="user-role">Role</label>
    <select class="form-control" name="user_role" id="user-role">
        <option value="subscriber">Select Options</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
    </select>
  </div>


  <div class="form-group">
    <label for="user-name">Username</label>
    <input type="text" name="username" class="form-control" id="user-name" placeholder="Username" required="true">
  </div>

  <div class="form-group">
    <label for="user-email">Email</label>
    <input type="email" name="user_email" class="form-control" id="user-email" placeholder="Email" required="true">
  </div>

  <div class="form-group">
    <label for="user-password">Password</label>
    <input type="password" name="user_password" class="form-control" id="user-password" placeholder="Password" required="true">
  </div>

  <button type="submit" name="createUser" class="btn btn-primary">Add User</button>
</form>