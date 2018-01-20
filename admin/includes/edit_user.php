<?php edit_user(); ?>

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
    <input type="password" class="form-control" name="user_password" value="<?php echo  $db_user_password; ?>">
  </div>
  <div class="form-group">
    <label for="role">Role</label>
    <select class="form-control" name="user_role">
      <option><?php echo $user_role; ?></option>
      <?php echo ($user_role == 'admin')?"<option>subscriber</option>":"<option>admin</option>";?>
    </select>
  </div>
  <div class="form-group">
    <label for="img">Image</label>
    <p><img src="../img/<?php echo $user_img; ?>" alt="<?php echo $username ?>" width="100"></p>
    <input type="file" class="form-control-file" name="user_img">
  </div>
  <button class="btn btn-primary" type="submit" name="update_user">Update</button>
</form>
<br>
<?php echo $message; ?>




