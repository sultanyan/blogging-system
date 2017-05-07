<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $comments = "SELECT * FROM `comments` ORDER BY `comment_id` DESC ";
        $comments_run = mysqli_query($con, $comments);
        while ($comments_row=mysqli_fetch_assoc($comments_run)) {
        $comment_id = $comments_row['comment_id'];
        $comment_author = $comments_row['comment_author'];
        $comment_post_id = $comments_row['comment_post_id'];
        $comment_email = $comments_row['comment_email'];
        $comment_content = $comments_row['comment_content'];
        $comment_status = $comments_row['comment_status'];
        $comment_date = $comments_row['comment_date'];
        ?>
        <tr>
            <td><?php echo $comment_id; ?></td>
            <td><?php echo $comment_author; ?></td>
            <td><?php echo $comment_content; ?></td>
            <td><?php echo $comment_email; ?></td>
            <td><?php echo $comment_status; ?></td>

            <?php 
                $related_with_posts = "SELECT * FROM `posts` WHERE `post_id` = '$comment_post_id' ";
                $related_with_posts_run = mysqli_query($con, $related_with_posts);
                while ($row_from_post = mysqli_fetch_assoc($related_with_posts_run)) {
                    $post_title = $row_from_post['post_title'];
                


            ?>
            <td><a href='../post.php?p_id=<?php echo $comment_post_id; ?>'><?php echo $post_title; ?></a></td>
            <?php } ?>
            <td><?php echo $comment_date; ?></td>
            <td><a href='comments.php?view_all_comments&approve=<?php echo $comment_id; ?>'><i class='fa fa-check' id='check'></i></a></td>
            <td><a href='comments.php?view_all_comments&unapprove=<?php echo $comment_id; ?>'><i class='fa fa-times' id='no'></i></a></td>
            <td><a href='comments.php?view_all_comments&delete=<?php echo $comment_id; ?>'><i class='fa fa-trash' id='trash'></i></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_comment = "DELETE FROM `comments` WHERE `comment_id` = '$delete_id' ";
    $delete_comment_run = mysqli_query($con, $delete_comment);
    if ($delete_comment_run) {
        header('Location: comments.php');
    }
}
?>

<?php
if (isset($_GET['unapprove'])) {
    $unapprove_id = $_GET['unapprove'];
    $unapprove_query = "UPDATE comments SET `comment_status`= 'unapproved' WHERE `comment_id` = '$unapprove_id' ";
    $unapprove_query_run = mysqli_query($con, $unapprove_query);
    if ($unapprove_query_run) {
        header('Location: comments.php');
    }
}
?>

<?php
    if (isset($_GET['approve'])) {
    $approve_id = $_GET['approve'];
    $approve_query = "UPDATE comments SET `comment_status`= 'approved' WHERE `comment_id` = '$approve_id' ";
    $approve_query_run = mysqli_query($con, $approve_query);
    if ($approve_query_run) {
        header('Location: comments.php');
    }
}
?>