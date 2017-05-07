  <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

            <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="POST">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search a post by tag name" name="search">
                            <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div> 

                <!-- LOGIN -->
                <div class="well">
                    <h4>Login for Admin</h4>
                    <form action="includes/login.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter username" name="username">
                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Enter password" name="password">
                            <span class="input-group-btn">
                                <button class="btn btn-default" name="login" type="submit">Log In</button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>


                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php 
                                $category_query = "SELECT * FROM `categories` ";
                                $category_query_run = mysqli_query($con, $category_query);
                                while($category_row = mysqli_fetch_assoc($category_query_run)){
                                $cat_id = $category_row['cat_id'];
                                $cat_title = $category_row['cat_title'];  ?>   
                                <li><a href="category.php?cat_id=<?php echo $cat_id; ?>"><?php echo $cat_title; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                       
                    </div>
                    <!-- /.row -->
                </div>

               <?php include 'includes/widget.php'; ?>

            </div>