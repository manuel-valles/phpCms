<?php insert_posts();?>

<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="post_title">
  </div>
  <div class="form-group">
    <label for="post_category">Post_Category Id</label>
    <select class="form-control" name="post_category_id">
      <?php 
      
      $query = "SELECT * FROM categories";
      $select_cat = mysqli_query($connection, $query);
      
      confirm_query($select_cat);
      while ($row = mysqli_fetch_assoc($select_cat)) {
          $cat_id = $row['cat_id'];
          $cat_title = $row['cat_title'];

          echo "<option value='{$cat_id}'>{$cat_title}</option>";
        } 
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="author">Author</label>
    <input type="text" class="form-control" name="post_author">
  </div>
  <div class="form-group">
    <label for="post_status">Status</label>
    <select class="form-control" name="post_status">
      <option>draft</option>
      <option>published</option>
    </select>
  </div>
  <div class="form-group">
    <label for="post_img">Image</label>
    <input type="file" class="form-control-file" name="post_img">
  </div>
  <div class="form-group">
    <label for="post_tags">Tags</label>
    <input type="text" class="form-control" name="post_tags">
  </div>
  <div class="form-group">
    <label for="post_content">Content</label>
    <textarea  type="text" class="form-control" name="post_content" rows="10"></textarea>
  </div>
  <button class="btn btn-primary" type="submit" name="create_post">Publish</button>
</form>