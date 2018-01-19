<?php  include "includes/header.php"; ?>

    <!-- Navigation -->    
    <?php  include "includes/nav.php"; ?>
    
    <?php 
        if(isset($_POST['submit'])){
            //Take data submitted
            $username =  $_POST['username'];
            $email =  $_POST['email'];
            $password =  $_POST['password'];
            //Escape that data before insert it into the DB
            $username = mysqli_real_escape_string($connection, $username);
            $email = mysqli_real_escape_string($connection, $email);
            $password = mysqli_real_escape_string($connection, $password);
            
            //Validation
            if(!empty($username) && !empty($email) && !empty($password)){
                // Encrypt the password
                $query = "SELECT randSalt FROM users";
                $getSalt = mysqli_query($connection, $query);
                confirm_query($getSalt);
                $row = mysqli_fetch_array($getSalt);
                //If the randSalt were empty, it would take the default value added into the DB
                $salt = $row['randSalt'];
                //Apply the crypt function
                $password = crypt($password, $salt);

                $query = "INSERT INTO users(username, user_password, user_email, user_role) ";
                $query .= "VALUES ('$username', '$password', '$email', 'subscriber')";
                $newUser = mysqli_query($connection, $query);
                confirm_query($newUser);
                //Message for the user
                $message = '<div class="alert alert-success">Your Registration has been submitted.</div>';
            } else {
                //Alert with JS
                $message = '<script>alert("Fields cannot be empty!")</script>';
            }
        }
    ?>

    <!-- Page Content -->
    <div class="container">
    
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                            <h1>Register</h1>
                            <form role="form" action="registration.php" method="POST" id="login-form" autocomplete="off">
                                <div class="form-group">
                                    <label for="username" class="sr-only">username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                                </div>
                                 <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                                </div>
                                 <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                </div>
                        
                                <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                            </form>
                        </div>
                        <!-- Message after submit -->
                        <br>
                        <?php echo (isset($message))?$message:''; ?>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>
        <hr>
        
    <!-- Footer -->
    <?php include "includes/footer.php";?>
