<?php
	if (isset($_POST['createPost'])) {
		$post_title = $_POST['post_title'];
		$post_category_id = $_POST['post_category'];
		$post_author = $_POST['post_author'];
		$post_status = $_POST['post_status'];
		$post_image = $_FILES['post_image']['name'];
		$post_image_temp = $_FILES['post_image']['tmp_name'];
		$post_tags = $_POST['post_tags'];
		$post_content = $_POST['post_content'];
		$post_date = date('d-m-y');
		// $post_comment_count = 4;

		move_uploaded_file($post_image_temp, "../images/$post_image");

		$insert_post = "INSERT INTO posts (`post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) VALUES ('$post_category_id', '$post_title', '$post_author', NOW(),  '$post_image', '$post_content', '$post_tags', '$post_status') ";
		$insert_post_run = mysqli_query($con, $insert_post);

		if ($insert_post_run) {
     $post_id = mysqli_insert_id($con);
      echo $added = "<div class='alert alert-success'>Post added. <a href='./posts.php'>Edit posts</a> or <a href='../post.php?p_id=$post_id'>View this post</a></div>";
    }else{
      echo "smth went wrong" . mysqli_error($con);
    }
    
	}
?>
<form method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post-title">Post Title</label>
    <input type="text" name="post_title" class="form-control" id="post-title" placeholder="Title" required="true">
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
    <label for="post-author">Post Author</label><br>
    <select class="form-control" name="post_author" id="post-author">
      <?php
        $author = "SELECT * FROM `users` WHERE `user_role` = 'admin' ";
        $author_run = mysqli_query($con, $author);
        while ($author_row = mysqli_fetch_assoc($author_run)) {
            $author_name = $author_row['user_firstname'];
            $author_lastname = $author_row['user_lastname'];
        }
        echo "<option>$author_name $author_lastname </option>";
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="post-status">Post Status</label>
    <select name="post_status" class="form-control" id="post-status">
      <option value="draft">Draft</option>
      <option value="published">Published</option>
    </select>
  </div>

  <div class="form-group">
    <label for="post-image">Post Image</label>
    <input type="file" name="post_image" class="form-control" id="post-image">
  </div>

  <div class="form-group">
    <label for="post-tags">Post Tags</label>
    <input type="text" name="post_tags" class="form-control" id="post-tags" placeholder="Post tags">
  </div>

   <div class="form-group">
    <label for="post-content">Post Content</label>
    <textarea name="post_content" class="form-control" id="post-content" rows="15" placeholder="Post content"></textarea>
  </div>

  <button type="submit" name="createPost" class="btn btn-primary">Publish</button>
</form>

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