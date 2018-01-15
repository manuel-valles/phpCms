<?php insert_users();?>

<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="firstname">First Name</label>
    <input type="text" class="form-control" name="user_firstname">
  </div>
  <div class="form-group">
    <label for="lastname">Last Name</label>
    <input type="text" class="form-control" name="user_lastname">
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" name="user_email">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="text" class="form-control" name="user_password">
  </div>
  <div class="form-group">
    <label for="role">Role</label>
    <select class="form-control" name="user_role">
      <option>admin</option>
      <option>subscriber</option>
    </select>
  </div>
  <div class="form-group">
    <label for="img">Image</label>
    <input type="file" class="form-control-file" name="user_img">
  </div>
  <button class="btn btn-primary" type="submit" name="create_user">Create</button>
</form>