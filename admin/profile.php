<?php include "includes/admin_header.php"; ?>

<?php edit_profile(); ?>

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
                        <form action="" method="POST" enctype="multipart/form-data">
                          <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
                          </div>
                          <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
                          </div>
                          <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $username; ?>"> 
                          </div>
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
                          </div>
                          <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="user_password" value="<?php echo  $user_password; ?>">
                          </div>
                          <div class="form-group">
                            <label for="img">Image</label>
                            <p><img src="../img/<?php echo $user_img; ?>" alt="<?php echo $username ?>" width="100"></p>
                            <input type="file" class="form-control-file" name="user_img">
                          </div>
                          <button class="btn btn-primary" type="submit" name="update_profile">Update</button>
                        </form>
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