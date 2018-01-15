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
                            Welcome To Admin
                            <small>User</small>
                        </h1>
                        <?php 
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        } else{
                            $source = '';
                        }
                        switch ($source) {
                            case 'add_comment':
                                include "includes/add_comment.php";
                                break;
                            
                            case 'edit_comment':
                                include "includes/edit_comment.php";
                                break;

                            default:
                                include "includes/display_all_comments.php";
                                approve_comments();
                                disapprove_comments();
                                delete_comments();
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