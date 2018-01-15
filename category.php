<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/nav.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <?php
                if (isset($_GET['cat_id'])) {
                    $post_category_id = $_GET['cat_id'];
                    $query = "SELECT * FROM posts WHERE post_category_id = {$post_category_id}";
                    $select_post = mysqli_query($connection, $query);

                    while ($post = mysqli_fetch_assoc($select_post)) {
                        $post_id = $post['post_id'];
                        $post_title = $post['post_title'];
                        $post_author = $post['post_author'];
                        $post_date = date("F jS, Y", strtotime($post['post_date']));
                        $post_img = $post['post_img'];
                        // Display a bit less content substr(string, start, end).
                        $post_content = substr($post['post_content'], 0 , 100) . ' ...';
                ?>
                <h2>
                    <a href="post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href=""><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="img/<?php echo $post_img ?>" width=900 alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

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
