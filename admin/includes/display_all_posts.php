<form action="" method="POST">
    <table class="table table-bordered table-hover">
        <div class="form-group">
            <div class="col-xs-6 col-md-3" id="bulkOptionContainer">
                <select class="form-control" name="bulkOption" id="">
                    <option value="">Select Option</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <button class="btn btn-warning" type="submit" name="bulkSubmit">Apply</button>
            <a class="btn btn-success" href="?source=add_post">Add Post</a>
        </div>
        <thead>
            <tr>
                <th><input class='form-check-input' type='checkbox' name="selectAll" id="selectAll"></th>
                <th>Id</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Content</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th colspan="2">Modify</th>
            </tr>
        </thead>
        <tbody>
            <?php display_posts(); ?>
        </tbody>
    </table>
</form>