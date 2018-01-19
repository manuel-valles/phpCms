<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/nav.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- First Blog Post -->
                <?php
                if(isset($_GET['author'])){
                    $author = $_GET['author'];
                ?>
                <h1 class="page-header">
                    Posts
                    <small>by <?php echo $author; ?></small>
                </h1>
                <?php
                    $query = mysqli_query($connection, "SELECT * FROM posts WHERE post_Status = 'published' AND post_author = '{$author}'");
                    confirm_query($query);
                    while($post = mysqli_fetch_assoc($query)){

                        $post_id = $post['post_id'];
                        $post_title = $post['post_title'];
                        $post_date = date("F jS, Y", strtotime($post['post_date']));
                        $post_img = $post['post_img'];
                        // Display a bit less content substr(string, start, end).
                        $post_content = substr($post['post_content'], 0, 50) . '...';
                
                ?>
                <h2>
                    <a href="post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?post_id=<?php echo $post_id ?>"><img class="img-responsive" src="img/<?php echo $post_img ?>" width=900 alt=""></a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>  
                <?php }} ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>
