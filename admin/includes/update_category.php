<?php

if(isset($_GET['edit_id'])){
    $edit_id = $_GET['edit_id'];
    $edit_title = $_GET['edit_title'];
    if(isset($_POST['update'])){

        $new_cat_title = $_POST['new_cat_title'];

        $query = mysqli_query($connection, "UPDATE categories SET cat_title = '{$new_cat_title}' WHERE cat_id = {$edit_id}");
        // To refresh the page : it avoids manually refreshes
        confirm_query($query);
        header("Location: categories.php");
    }
?>
<form action="" method="POST">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>
        <input class="form-control" type="text" name="new_cat_title" value="<?php if(isset($_GET['edit_title'])) echo $edit_title; ?>">
    </div>
    <button class="btn btn-primary" type="submit" name="update">Update Category</button>
</form>

<?php } ?>