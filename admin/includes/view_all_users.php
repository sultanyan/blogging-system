<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date</th>
            <th>Change Role</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $users = "SELECT * FROM `users` ";
        $users_run = mysqli_query($con, $users);
        while ($users_row=mysqli_fetch_assoc($users_run)) {
        $user_id = $users_row['user_id'];
        $username = $users_row['username'];
        $user_firstname = $users_row['user_firstname'];
        $user_lastname = $users_row['user_lastname'];
        $user_email = $users_row['user_email'];
        $user_image = $users_row['user_image'];
        $user_role = $users_row['user_role'];
        $user_reg_date = $users_row['user_reg_date'];
        ?>
        <tr>
            <td><?php echo $user_id; ?></td>
            <td><?php echo $username; ?></td>
            <td><?php echo $user_firstname; ?></td>
            <td><?php echo $user_lastname; ?></td>
            <td><?php echo $user_email; ?></td>
            <td><?php echo $user_role; ?></td>
            <td><?php echo $user_reg_date; ?></td>

            <td><a href='users.php?view_all_users&make_sub=<?php echo $user_id; ?>'>Make Subscriber</a><br>
           <a href='users.php?view_all_users&make_admin=<?php echo $user_id; ?>'>Make Admin</a></td>
           <td><a href='users.php?src=edit_user&u_id=<?php echo $user_id; ?>'><i class='fa fa-pencil' id='pen3'></i></a></td>
            <td><a href='users.php?view_all_users&delete=<?php echo $user_id; ?>'><i class='fa fa-trash' id='trash3'></i></a></td>
             <?php } ?>
        </tr>
    </tbody>
</table>

<?php 
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_user = "DELETE FROM `users` WHERE `user_id` = '$delete_id' ";
    $delete_user_run = mysqli_query($con, $delete_user);
    if ($delete_user_run) {
        header('Location: users.php');
    }
}
?>

<?php 
if (isset($_GET['make_sub'])) {
    $make_sub_id = $_GET['make_sub'];
    $make_sub_user = "UPDATE `users` SET `user_role` = 'subscriber' WHERE `user_id` = '$make_sub_id' ";
    $make_sub_user_run = mysqli_query($con, $make_sub_user);
    if ($make_sub_user_run) {
        header('Location: users.php');
    }
}
?>

<?php 
if (isset($_GET['make_admin'])) {
    $make_adm_id = $_GET['make_admin'];
    $make_adm_user = "UPDATE `users` SET `user_role` = 'admin' WHERE `user_id` = '$make_adm_id' ";
    $make_adm_user_run = mysqli_query($con, $make_adm_user);
    if ($make_adm_user_run) {
        header('Location: users.php');
    }
}
?>