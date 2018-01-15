            <div class="col-md-4">
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <!-- Search Form -->
                    <form action="search.php" method="POST">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>

                    <!-- /.input-group -->
                </div>
                
                <!-- Login -->
                <div class="well">
                    <h4>Login</h4>
                    <!-- Search Form -->
                    <form action="includes/login.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Enter Username">
                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control" name="user_password" placeholder="Enter Password">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="login">Log In</button>
                            </span>
                        </div> 
                    </form>

                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            <?php  
                                $query = mysqli_query($connection, "SELECT * FROM categories");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    echo "<li><a href='category.php?cat_id=$cat_id'>$cat_title</a></li>";
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>

            </div>