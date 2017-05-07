<?php require 'db.php'; ?>
<?php session_start(); ?>

<?php 
	if (isset($_POST['login'])) {
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$password = mysqli_real_escape_string($con, $_POST['password']); 

		$check_query = "SELECT * FROM `users` WHERE `username` = '$username' ";
		$check_query_run = mysqli_query($con, $check_query);

		while ($login_row = mysqli_fetch_array($check_query_run)) {
			$db_login_id = $login_row['user_id'];
			$db_username = $login_row['username'];
			$db_password = $login_row['user_password'];
			$db_user_first_name = $login_row['user_firstname'];
			$db_user_last_name = $login_row['user_lastname'];
			$db_user_role = $login_row['user_role'];
		}


			if ($username !== $db_username && $password !== $db_password) {
				header('Location: ../index.php');
			}elseif ($username == $db_username && $password == $db_password) {
				$_SESSION['username'] = $db_username;
				$_SESSION['firstname'] = $db_user_first_name;
				$_SESSION['lastname'] = $db_user_last_name;
				$_SESSION['user_role'] = $db_user_role;
				header('Location: ../admin/index.php');
			}else {
				header('Location: ../index.php');
			}
	}
?>