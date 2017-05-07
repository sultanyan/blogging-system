<?php
    $p_id = $_GET['p_id'];
    $select_post = "SELECT * FROM `posts` WHERE `post_id` = '$p_id' ";
    $select_post_run = mysqli_query($con, $select_post);

    $row_post = mysqli_fetch_array($select_post_run);
    $post_title = $row_post['post_title'];
    $post_cat_id = $row_post['post_category_id'];
    $post_author = $row_post['post_author'];
    $post_status = $row_post['post_status'];
    $post_image = $row_post['post_image'];
    $post_tags = $row_post['post_tags'];
    $post_content = $row_post['post_content'];


// ________________________________________

    if (isset($_POST['updatePost'])) {
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 4;

    if (empty($post_image)) {
        $img = "SELECT * FROM `posts` WHERE `post_id` = $p_id ";
        $img_run = mysqli_query($con, $img);
        while ($row = mysqli_fetch_assoc($img_run)) {
            $post_image = $row['post_image'];
        }
    }

    $p_id = $_GET['p_id'];
    $select_post = "SELECT * FROM `posts` WHERE `post_id` = '$p_id' ";
    $select_post_run = mysqli_query($con, $select_post);

    $row_post = mysqli_fetch_array($select_post_run);
    $post_id = $row_post['post_id'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $update_post = "UPDATE `posts` SET `post_title` = '$post_title', `post_category_id` = '$post_category_id', `post_author` = '$post_author', `post_status` = '$post_status', `post_image` = '$post_image', `post_tags` = '$post_tags', `post_content` = '$post_content' WHERE `post_id` = '$p_id' ";
    $update_post_run = mysqli_query($con, $update_post);
    if ($update_post_run) {
      echo $updated = "<div class='alert alert-success'>Post updated. <a href='./posts.php'>Edit posts</a> or <a href='../post.php?p_id=$post_id'>View this post</a></div>";
    }else{
      echo "smth went wrong" . mysqli_error($con);
    }
  }

?>

<form method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post-title">Post Title</label>
    <input type="text" name="post_title" class="form-control" id="post-title" placeholder="Title" required="true" value="<?php echo $post_title; ?>">
  </div>

  <div class="form-group">
  <label for="post-category">Post Category</label>
    <select class="form-control" name="post_category" id="select-category">
      <?php 
        $cat = "SELECT * FROM `categories` ";
        $cat_run = mysqli_query($con, $cat);

        while ($cat_row = mysqli_fetch_assoc($cat_run)) {
          $cat_id = $cat_row['cat_id'];
          $cat_title = $cat_row['cat_title'];
          echo "<option value='$cat_id'> $cat_title </option>";
        }
      ?>
    </select>
  </div>
 
  <div class="form-group">
    <label for="post-author">Post Author</label>
    <input type="text" name="post_author" class="form-control" id="post-author" placeholder="Post author" required="true" value="<?php echo $post_author; ?>">
  </div>

  <div class="form-group">
    <label for="post-status">Post Status</label>
    <select name="post_status" class="form-control" id="post-status">
      <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
      <?php
        if ($post_status == 'draft') {
          echo "<option value='published'>published</option>";
        }elseif ($post_status == 'published') {
          echo "<option value='draft'>draft</option>";
        }
      ?>

    </select>
  </div>

  <div class="form-group">
    <label for="post-image">Post Image</label><br>
    <img src="../images/<?php echo $post_image; ?>" width='100' alt=""><br>
    <input type="file" name="post_image">
  </div>

  <div class="form-group">
    <label for="post-tags">Post Tags</label>
    <input type="text" name="post_tags" class="form-control" id="post-tags" placeholder="Post tags" value="<?php echo $post_tags; ?>" required="true">
  </div>

   <div class="form-group">
    <label for="post-content">Post Content</label>
    <textarea name="post_content" class="form-control" id="post-content" rows="15" placeholder="Post content" required="true"><?php echo $post_content; ?></textarea>

<script>
  tinymce.init({
  selector: 'textarea',
  height: 500,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools'
  ],
  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });
</script>

  </div>

  <button type="submit" name="updatePost" class="btn btn-primary">Update</button>
</form>

<?php 

?>