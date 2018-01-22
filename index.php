<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/nav.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Published Posts
                </h1>

                <!-- First Blog Post -->
                <?php

                // To limit the pagination I need to know how many published posts are
                $query =  "SELECT * FROM posts WHERE post_Status = 'published'";
                $published_posts = mysqli_query($connection, $query);
                confirm_query($published_posts);
                $count_rows = mysqli_num_rows($published_posts);
                // Set how many posts we want per page
                $posts_per_page = 5;
                // Get how many posts would be after that limit - Ceil for no float
                $pages = ceil($count_rows / $posts_per_page);
                // Check we don't get an undefined page
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                } else{
                    $page = "";
                }
                // Assign a variable - $post_1 - to add it to the LIMIT query
                if($page == ""  || $page == 1){
                    // The value is 0 for the homepage
                    $post_1 = 0;
                } else{
                    $post_1 = ($page * $posts_per_page) - $posts_per_page;
                }

                // Set this variable to the start LIMIT - dynamically
                $query = mysqli_query($connection, "SELECT * FROM posts WHERE post_Status = 'published' LIMIT $post_1, $posts_per_page");
                confirm_query($query);
                while($post = mysqli_fetch_assoc($query)){

                    $post_id = $post['post_id'];
                    $post_title = $post['post_title'];
                    $post_author = $post['post_author'];
                    $post_date = date("F jS, Y", strtotime($post['post_date']));
                    $post_img = $post['post_img'];
                    // Display a bit less content substr(string, start, end).
                    $post_content = substr($post['post_content'], 0, 50) . '...';
                ?>
                <h2>
                    <a href="post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?post_id=<?php echo $post_id ?>"><img class="img-responsive" src="img/<?php echo $post_img ?>" width=900 alt=""></a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>  
                <?php } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>
        
        <!-- Pagination -->
        <ul class="pager">
            <?php
                // Loop to get the pages - class 'pager' from Bootstrap v3
                for($i=1; $i<=$pages; $i++){
                    echo "<li><a href='?page={$i}'>{$i}</a></li>";
                }
            ?>
        </ul>
        <!-- Footer -->
        <?php include "includes/footer.php" ?>
