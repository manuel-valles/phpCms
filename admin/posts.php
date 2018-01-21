<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_nav.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Posts
                        <?php 
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        } else{
                            $source = '';
                        }
                        switch ($source) {
                            case 'add_post':
                                echo "<small>- Create</small></h1>";
                                include "includes/add_post.php";
                                break;
                            
                            case 'edit_post':
                                echo "<small>- Edit</small></h1>";
                                include "includes/edit_post.php";
                                break;

                            default:
                                echo "</h1>";
                                include "includes/display_all_posts.php";
                                reset_views_post();
                                delete_post();
                                break;
                        }                              

                        ?>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>