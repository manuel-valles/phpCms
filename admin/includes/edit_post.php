<?php edit_post(); ?>

<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="post_title" value="<?php echo $post_title;?>">
  </div>
  <div class="form-group">
  	<label for="post_category">Category</label>
    <select class="form-control" name="post_category_id">
    	<?php 
			
			$query = "SELECT * FROM categories";
			$select_cat = mysqli_query($connection, $query);
			
			confirm_query($select_cat);
			while ($row = mysqli_fetch_assoc($select_cat)) {
					$cat_id = $row['cat_id'];
					$cat_title = $row['cat_title'];

					echo "<option value='{$cat_id}' ";
					if ($post_category_id==$cat_id) echo "selected='selected'";
					echo ">{$cat_title}</option>";
			} 
    	?>
    </select>
  </div>
  <div class="form-group">
    <label for="author">Author</label>
    <input type="text" class="form-control" name="post_author" value="<?php echo $post_author;?>">
  </div>
  <div class="form-group">
    <label for="post_status">Status</label>
    <select class="form-control" name="post_status">
      <?php  
      echo "<option ";
      if ($post_status=='draft') echo "selected='selected'";
      echo ">draft</option>";
      echo "<option ";
      if ($post_status=='published') echo "selected='selected'";
      echo ">published</option>";
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="post_img">Image</label>
    <p><img src="../img/<?php echo $post_img;?>" width="100" alt="<?php echo $post_title;?>"></p>
    <input type="file" class="form-control-file" name="post_img">
  </div>
  <div class="form-group">
    <label for="post_tags">Tags</label>
    <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
  </div>
  <div class="form-group">
    <label for="post_content">Content</label>
    <textarea  type="text" class="form-control" name="post_content" rows="10"><?php echo $post_content; ?></textarea>
  </div>
  <button class="btn btn-primary" type="submit" name="update_post">Update Post</button>
</form>