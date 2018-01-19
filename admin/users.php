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
                            Users
                        <?php 
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        } else{
                            $source = '';
                        }
                        switch ($source) {
                            case 'add_user':
                                echo "<small>- Create</small></h1>";
                                include "includes/add_user.php";
                                break;
                            
                            case 'edit_user':
                                echo "<small>- Edit</small></h1>";
                                include "includes/edit_user.php";
                                break;

                            default:
                                echo "</h1>";
                                include "includes/display_all_users.php";
                                change_to_admin();
                                change_to_subscriber();
                                delete_users();
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