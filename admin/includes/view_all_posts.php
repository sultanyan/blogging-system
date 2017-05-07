<?php
    if (isset($_POST['checkBoxArray'])) {
        foreach ($_POST['checkBoxArray'] as $postValueId) {
           $bulk_options = $_POST['bulk_options'];
           switch ($bulk_options) {
                case 'published':
                    $update_published_query = "UPDATE `posts` SET `post_status` = '{$bulk_options}' WHERE `post_id` = '{$postValueId}' ";
                    $update_published_query_run = mysqli_query($con, $update_published_query);
                break;

                case 'draft':
                    $update_draft_query = "UPDATE `posts` SET `post_status` = '$bulk_options' WHERE `post_id` = '$postValueId' ";
                    $update_draft_query_run = mysqli_query($con, $update_draft_query);
                break;

                case 'clone':
                    $clone_query = "SELECT * FROM `posts` WHERE `post_id` = '$postValueId' ";
                    $clone_query_run = mysqli_query($con, $clone_query);
                    while ($row_clone = mysqli_fetch_array($clone_query_run)) {
                        $post_title = $row_clone['post_title'];
                        $post_author = $row_clone['post_author'];
                        $post_date = $row_clone['post_date'];
                        $post_category_id = $row_clone['post_category_id'];
                        $post_status = $row_clone['post_status'];
                        $post_image = $row_clone['post_image'];
                        $post_tags = $row_clone['post_tags'];
                        $post_content = $row_clone['post_content'];
                    }
                   $insert_post = "INSERT INTO `posts`(`post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) VALUES ('$post_category_id', '$post_title', '$post_author', NOW(),  '$post_image', '$post_content', '$post_tags', '$post_status') ";
                    $insert_post_run = mysqli_query($con, $insert_post);
                break;

                case 'delete':
                    $delte_post_query = "DELETE FROM `posts` WHERE `post_id` = '$postValueId' ";
                    $delete_post_query_run = mysqli_query($con, $delte_post_query);
                break;
           }
        }
    }
?>

<form action="" method="post">

    <div id="bulkOptionsContainer" class="col-xs-4">
        <select name="bulk_options" id="" class="form-control">
            <option value="">Select Options</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
            <option value="clone">Clone</option>
            <option value="delete">Delete</option>
        </select><br>
    </div>

    <div class="col-xs-4">
        <input type="submit" name="submit" value="Apply" class="btn btn-success">
        <a href="./posts.php?src=add_post" class="btn btn-primary">Add New</a>
    </div>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th><input type="checkbox" id="selectAllBoxes"></th>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>All Views</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $posts = "SELECT * FROM `posts` ";
        $posts_run = mysqli_query($con, $posts);
        while ($posts_row=mysqli_fetch_assoc($posts_run)) {
        $post_id = $posts_row['post_id'];
        $post_author = $posts_row['post_author'];
        $post_title = $posts_row['post_title'];
        $post_category_id = $posts_row['post_category_id'];
        $post_status = $posts_row['post_status'];
        $post_image = $posts_row['post_image'];
        $post_tags = $posts_row['post_tags'];
        $post_comment_count = $posts_row['post_comment_count'];
        $post_date = $posts_row['post_date'];
        $post_views = $posts_row['post_views_count'];
        ?>
        <tr>

              <?php 
                  $query = "SELECT * FROM `categories` WHERE `cat_id` = '$post_category_id' ";
                  $query_run = mysqli_query($con, $query);
                  while ($row = mysqli_fetch_assoc($query_run)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                  
              ?>  

            <td> <input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id; ?>'> </td>
            <td><?php echo $post_id; ?></td>
            <td><?php echo $post_author; ?></td>
            <td><?php echo $post_title; ?></td>
            <td><?php echo $cat_title; ?></td>
            <td><?php echo $post_status; ?></td>
            <td id='img'><?php echo "<img class='img-responsive' id='post_image' src='../images/$post_image '>" ?></td>
            <td><?php echo $post_tags; ?></td>
            <td><?php echo $post_comment_count; ?></td>
            <td><?php echo $post_date; ?></td>
            <td><?php echo $post_views;?> <a class='btn btn-default btn-sm reset' href='posts.php?reset_viwes=<?php echo $post_id; ?>'>Reset</a>
            </td>

            <td><a href='../post.php?p_id=<?php echo $post_id;?>'><i class='fa fa-eye' id='eye'></i></a></td>
            <td><a href='posts.php?src=edit_post&p_id=<?php echo $post_id;?>'><i class='fa fa-pencil' id='pencil'></i></a></td>
            <td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?view_all_posts&delete=<?php echo $post_id; ?>'><i class='fa fa-trash' id='trash'></i></a></td>
        </tr>
        <?php } } ?>
    </tbody>
</table>
</form>

<?php
    if (isset($_GET['reset_viwes'])) {
        $reset_id = $_GET['reset_viwes'];
        $reset = "UPDATE `posts` SET `post_views_count` = 0 WHERE `post_id` = '$reset_id' ";
        $reset_run = mysqli_query($con, $reset);
        if ($reset_run) {
            header('location: posts.php');
        }
    }
?>

<?php 
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_post = "DELETE FROM `posts` WHERE `post_id` = '$delete_id' ";
    $delete_post_run = mysqli_query($con, $delete_post);
    if ($delete_post_run) {
        header('Location: posts.php');
    }
}

?>