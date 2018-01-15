<?php include "includes/admin_header.php"; ?>
<?php 
    // Some variables for our chart - used the function count_data() 
    $posts_count = count_data('posts');
    $posts_published_count = count_data("posts", "WHERE post_status = 'published'");
    $posts_draft_count = count_data("posts", "WHERE post_status = 'draft'");
    $categories_count = count_data('categories');
    $users_count = count_data('users');
    $users_admin_count = count_data("users", "WHERE user_role = 'admin'");
    $users_subscriber_count = count_data("users", "WHERE user_role = 'subscriber'");
    $comments_count = count_data('comments');
    $comments_approved_count = count_data("comments", "WHERE comment_status = 'Approved'");
    $comments_unapproved_count = count_data("comments", "WHERE comment_status = 'Unapproved'");
    $comments_submitted_count = count_data("comments", "WHERE comment_status = 'Submitted'");

?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_nav.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Count Display-->                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                  <div class='huge'><?php echo $posts_count;?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                     <div class='huge'><?php echo $comments_count;?></div>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $users_count;?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $categories_count;?></div>
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Chart from Google API -->
                <div class="row">
                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <script type="text/javascript">
         google.charts.load('current', {'packages':['bar']});
         google.charts.setOnLoadCallback(drawChart);

         function drawChart() {
           var data = google.visualization.arrayToDataTable([
             ['Data', 'Count'],
             // Bring data dynamically
             <?php
             echo  "['Published Posts', $posts_published_count],
                    ['Draft Posts', $posts_draft_count],
                    ['Approved Comments', $comments_approved_count],
                    ['Unapproved Comments', $comments_unapproved_count],
                    ['Submitted Comments', $comments_submitted_count],
                    ['Admins', $users_admin_count],
                    ['Subscribers', $users_subscriber_count],
                    ['Categories', $categories_count],
                    "
             ?>
           ]);

           var options = {
             chart: {
               title: '',
               subtitle: '',
             }
           };

           var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
           chart.draw(data, google.charts.Bar.convertOptions(options));
         }
    </script>
   
    <div id="columnchart_values" style="width: 900px; height: 300px;"></div>




<?php include "includes/admin_footer.php"; ?>