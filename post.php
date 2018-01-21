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
                if (isset($_GET['post_id'])) {
                    $post_id = $_GET['post_id'];
                    //Count every time somebody access to the post - this code is executed
                    $query = "UPDATE posts SET post_views = post_views + 1 ";
                    $query .= "WHERE post_id = {$post_id}";
                    $update_post_views = mysqli_query($connection, $query);
                    confirm_query($update_post_views);
                    $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
                    $select_post = mysqli_query($connection, $query);
                    confirm_query($select_post);
                    $post_selected = mysqli_fetch_assoc($select_post);

                    $post_title = $post_selected['post_title'];
                    $post_author = $post_selected['post_author'];
                    $post_date = date("F jS, Y", strtotime($post_selected['post_date']));
                    $post_img = $post_selected['post_img'];
                    $post_content = $post_selected['post_content'];
                
                ?>
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="img/<?php echo $post_img ?>" width=900 alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>
                <?php } ?>
                <!-- Blog Comments -->
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="comment_author">Name</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="text" class="form-control" name="comment_email">
                        </div>                      
                        <div class="form-group">
                            <label for="comment-content">Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>
                <!-- Result Submit -->
                <?php insert_comment(); ?>
                <hr>

                <!-- Posted Comments -->
                <?php


                    $query = "SELECT * FROM comments ";
                    $query .= "WHERE comment_post_id = '$post_id' AND comment_status = 'Approved' ";
                    $query .= "ORDER BY comment_date DESC";
                    $select_comments = mysqli_query($connection, $query); 
                    confirm_query($select_comments);
                    while ($row = mysqli_fetch_assoc($select_comments)) {
                        $comment_author = $row['comment_author'];
                        $comment_content = $row['comment_content'];
                        $comment_date = date("F j, Y, g:i a", strtotime($row['comment_date']));

                ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <p><?php echo $comment_content; ?></p>
                    </div>
                </div>
                <?php } ?>
                <hr>
                <!-- End Comments -->
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>
