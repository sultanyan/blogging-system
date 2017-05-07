<?php require 'includes/db.php';?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>

<?php
	if (isset($_POST['submit'])) {
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$email = mysqli_real_escape_string($con, $_POST['email']);

		if (!empty($username) && !empty($password) && !empty($email)) {
			$query = "SELECT `user_randSalt` FROM `users` ";
			$query_rand_salt = mysqli_query($con, $query);
			
			$row = mysqli_fetch_array($query_rand_salt);
			$salt = $row['user_randSalt'];
			$password = crypt($password, $salt);
			
			$reg = "INSERT INTO `users` (`username`, `user_email`, `user_password`, `user_role`, `user_reg_date`) VALUES ('$username', '$email', '$password', 'subscriber', NOW()) ";
			$reg_run = mysqli_query($con, $reg);
			
			$message = "<div class='alert alert-success text-center'> Registration successful. </div>";
		}else {
			$message = "<div class='alert alert-danger text-center'> Please fill in all fields. </div>";
		}
	}else {
			$message = '';
	}
?>

<div class="container">
	<section class="login">
		<div class="row">
			<div class="col-xs-6 col-xs-offset-3">
				<div class="form-wrap">
					<h1 class="text-center">Register</h1>
					<form action="registration.php" method="POST" id="login-form" autocomplete="off" role="form">
						<?php echo $message; ?>
						<div class="form-group">
							<label for="username" class="sr-only">Username</label>
							<input type="text" id="username" name="username" class="form-control" placeholder="Enter Desired Username">
						</div>
						<div class="form-group">
							<label for="email" class="sr-only">Email</label>
							<input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
						</div>
						<div class="form-group">
							<label for="password" class="sr-only">Password</label>
							<input type="password" name="password" id="key" class="form-control" placeholder="Password">
						</div>
						<input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
					</form>
				</div>
			</div>
		</div>
	</section>
</div>

