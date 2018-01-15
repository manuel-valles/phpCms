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
                        <div class="col-xs-6">
                            <!-- Insert Categories -->
                            <?php insert_categories();?>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <button class="btn btn-primary" type="submit" name="submit">Add Category</button>
                            </form>
                            <br>
                            <!-- Update Categories -->
                            <?php include "includes/update_category.php"; ?>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th colspan=2>Modify</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Display categories  -->
                                    <?php display_categories();?>
                                    <!-- Delete categories  -->
                                    <?php delete_categories();?>
                                </tbody>
                            </table>
                        </div>
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