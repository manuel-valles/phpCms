<?php 

function confirm_query($result){

	global $connection;

	if(!$result){

	    die("Query failed! <br>" . mysqli_error($connection));

	}
}

function insert_categories(){

	global $connection;

	if(isset($_POST['submit'])){

	    $cat_title = $_POST['cat_title'];

	    if($cat_title == "" || empty($cat_title)){

	        echo "This field should not be empty.";

	    } else{
	        $query = mysqli_query($connection, "INSERT INTO categories(cat_title) VALUES('{$cat_title}')");
	        if(!$query){
	            die("Query failed!" . mysqli_error($connection));
	        }
	    }
	}

}

function display_categories(){
	global $connection;

    $query = mysqli_query($connection, "SELECT * FROM categories");
    while ($row = mysqli_fetch_assoc($query)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>
	    		<td>{$cat_id}</td>
	    		<td>{$cat_title}</td>
			    <td><a href='categories.php?edit_id={$cat_id}&edit_title={$cat_title}'>Edit</a></td>
			    <td><a onclick=\"return confirm('Are you sure you want to delete the category with id {$cat_id}?')\" href='categories.php?delete={$cat_id}'>Delete</a></td>
			</tr>";
	}
}

function delete_categories(){
	global $connection;

	if(isset($_GET['delete'])){
	    $delete = $_GET['delete'];
	    $query = mysqli_query($connection, "DELETE FROM categories WHERE cat_id={$delete}");
	    // To refresh the page : it avoids manually refreshes
	    header("Location: categories.php");
	}
}

function display_posts(){
	global $connection;

	if(isset($_POST['checkBoxArray'])){
		$checkBoxArray = $_POST['checkBoxArray'];
		$bulkOption = $_POST['bulkOption'];
		if($bulkOption !==""){
			foreach($checkBoxArray as $checkBoxValue){
				if($bulkOption === "delete"){
					$query = "DELETE FROM posts ";
				} else{
					$query = "UPDATE posts SET post_status = '{$bulkOption}' ";
				}
				$query .= "WHERE post_id = $checkBoxValue";
				$update_status = mysqli_query($connection, $query);
				confirm_query($update_status);
			}
		}
	}
    $query = "SELECT * FROM posts";
    $select_posts = mysqli_query($connection, $query); 

    while ($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_img = $row['post_img'];
        $post_content = substr($row['post_content'], 0, 30) . '<span>...</span>';
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
		
		$query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
		$select_category = mysqli_query($connection, $query);
		confirm_query($select_category);
		$category_selected = mysqli_fetch_assoc($select_category);
		$post_category_title = $category_selected['cat_title'];

		
        echo "<tr>
        		<td><input class='form-check-input checkBox' type='checkbox' name='checkBoxArray[]' value='{$post_id}'></td>
	    		<td>{$post_id}</td>
	    		<td><a href='../post.php?post_id={$post_id}'>{$post_title}</a></td>
	    		<td>{$post_author}</td>
	    		<td>{$post_category_title}</td>
	    		<td>{$post_status}</td>
	    		<td><img src='../img/{$post_img}'' alt='{$post_title}' height=30></td>
	    		<td>{$post_content}</td>
	    		<td>{$post_tags}</td>
	    		<td>{$post_comment_count}</td>
	    		<td>{$post_date}</td>
	    		<td><a href='posts.php?source=edit_post&post_id={$post_id}'>Edit</a></td>
	    		<td><a onclick=\"return confirm('Are you sure you want to delete the post with id {$post_id}?')\" href='posts.php?delete={$post_id}'>Delete</a></td>
			</tr>";
	}
}

function insert_posts(){

	global $connection;
	
	if(isset($_POST['create_post'])){

		$post_title = $_POST['post_title'];
		$post_category_id = $_POST['post_category_id'];
		$post_author = $_POST['post_author'];
		$post_status = $_POST['post_status'];
		// We need to use the super globals $_FILES and a temporary location
		$post_img = $_FILES['post_img']['name'];
		$post_img_tmp = $_FILES['post_img']['tmp_name'];
		$post_tags = $_POST['post_tags'];
		$post_content = mysqli_escape_string($connection, $_POST['post_content']);
		
		// move_uploaded_file(filename, destination)
		move_uploaded_file($post_img_tmp, "img/$post_img");
		
		$query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_status) ";
		$query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_img}', '{$post_content}', '{$post_tags}', '{$post_status}')";

		$query_add_post = mysqli_query($connection, $query);
        
        confirm_query($query_add_post);

        // I want to go to view all post after insertion
	    // header("Location: posts.php");

	    // To pull out the last created id
	    $post_id = mysqli_insert_id($connection);
	    
	    echo "<div class='alert alert-success'>
    		<p><strong>Post created successfully</strong></p>
    		<p><a href='../post.php?post_id={$post_id}'>View This Post</a></p>
    		<p><a href='posts.php'>Edit More Posts</a></p>
    		</div>";
	}

}

function delete_posts(){
	global $connection;

	if(isset($_GET['delete'])){
	    $delete = $_GET['delete'];
	    $query = mysqli_query($connection, "DELETE FROM posts WHERE post_id={$delete}");
	    // To refresh the page : it avoids manually refreshes
	    header("Location: posts.php");
	}
}

function edit_post(){
	global $connection, $post_title, $post_category_id, $post_author, $post_status, $post_img, $post_tags, $post_content, $post_comment_count;

	if(isset($_GET['post_id'])){
	    $post_id = $_GET['post_id'];
	    $query = mysqli_query($connection, "SELECT * FROM posts WHERE post_id={$post_id}");
	    $post = mysqli_fetch_assoc($query);
        $post_title = $post['post_title'];
        $post_category_id = $post['post_category_id'];
        $post_author = $post['post_author'];
        $post_status = $post['post_status'];
        $post_img = $post['post_img'];
        $post_tags = $post['post_tags'];
        $post_content = $post['post_content'];
	}

	if(isset($_POST['update_post'])){

		$post_title = $_POST['post_title'];
		$post_category_id = $_POST['post_category_id'];
		$post_author = $_POST['post_author'];
		$post_status = $_POST['post_status'];
		$post_img = $_FILES['post_img']['name'];
		$post_img_tmp = $_FILES['post_img']['tmp_name'];
		$post_tags = $_POST['post_tags'];
		$post_content = mysqli_escape_string($connection, $_POST['post_content']);

	    // move_uploaded_file(filename, destination)
		move_uploaded_file($post_img_tmp, "../img/$post_img");
		
		// if we don't change the image or it's empty
		if(empty($post_img)){

			$query = "SELECT * FROM posts WHERE post_id = $post_id";
			$select_image = mysqli_query($connection, $query);
			$post_selected = mysqli_fetch_assoc($select_image);
			
			confirm_query($post_selected);
			
			$post_img = $post_selected['post_img'];
		}
		
		$query = "UPDATE posts SET ";
		$query .= "post_title = '{$post_title}', ";
		$query .= "post_category_id = '{$post_category_id}', ";
		$query .= "post_date = now(), ";
		$query .= "post_author = '{$post_author}', ";
		$query .= "post_status = '{$post_status}', ";
		$query .= "post_img = '{$post_img}', ";
		$query .= "post_tags = '{$post_tags}', ";
		$query .= "post_content = '{$post_content}' ";
		$query .= "WHERE post_id = {$post_id}";
		
		$update_post = mysqli_query($connection, $query);
		confirm_query($update_post);

	    echo "<div class='alert alert-success'>
    		<p><strong>Post updated successfully</strong></p>
    		<p><a href='../post.php?post_id={$post_id}'>View This Post</a></p>
    		<p><a href='posts.php'>Edit More Posts</a></p>
    		</div>";
	}
}

function display_comments(){
	global $connection;

    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($connection, $query); 

    while ($row = mysqli_fetch_assoc($select_comments)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
		
		$query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
		$select_post = mysqli_query($connection, $query);
		confirm_query($select_post);
		$post_selected = mysqli_fetch_assoc($select_post);
		$post_category_id = $post_selected['post_id'];
		$post_category_title = $post_selected['post_title'];


        echo "<tr>
	    		<td>{$comment_id}</td>
	    		<td>{$comment_author}</td>
	    		<td>{$comment_content}</td>
	    		<td>{$comment_email}</td>
	    		<td>{$comment_status}</td>
	    		<td><a href='../post.php?post_id={$post_category_id}'>{$post_category_title}</a></td>
	    		<td>{$comment_date}</td>
	    		<td><a href='comments.php?approve={$comment_id}'>Approved</a></td>
	    		<td><a href='comments.php?disapprove={$comment_id}'>Unapproved</a></td>
	    		<td><a onclick=\"return confirm('Are you sure you want to delete the comment with id {$comment_id}?')\"  href='comments.php?delete={$comment_id}'>Delete</a></td>
			</tr>";
	}
}

function approve_comments(){
	global $connection;

	if(isset($_GET['approve'])){
	    $comment_id = $_GET['approve'];
	    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$comment_id}";
	    $update_status = mysqli_query($connection, $query);
	    confirm_query($update_status); 
	    // To refresh the page : it avoids manually refreshes
	    header("Location: comments.php");
	}
}

function disapprove_comments(){
	global $connection;

	if(isset($_GET['disapprove'])){
	    $comment_id = $_GET['disapprove'];
	    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$comment_id}";
	    $update_status = mysqli_query($connection, $query);
	    confirm_query($update_status); 
	    // To refresh the page : it avoids manually refreshes
	    header("Location: comments.php");
	}
}

function delete_comments(){
	global $connection;

	if(isset($_GET['delete'])){
	    $delete = $_GET['delete'];
	    $query = mysqli_query($connection, "DELETE FROM comments WHERE comment_id={$delete}");
	    // To refresh the page : it avoids manually refreshes
	    header("Location: comments.php");
	}
}

function insert_comment(){

	global $connection;

	if(isset($_POST['create_comment'])){

		$post_id = $_GET['post_id'];
		$comment_author = $_POST['comment_author'];
		$comment_email = $_POST['comment_email'];
		$comment_content = mysqli_escape_string($connection, $_POST['comment_content']);

		// Add some validation
		if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
			$query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
	        $query .= "VALUES('{$post_id}', '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Submitted', now())";
			$insert_comment =  mysqli_query($connection, $query);
	        confirm_query($insert_comment);

	        // Update count of comments every time we insert a comment
	        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
			$query .= "WHERE post_id = {$post_id}";
			$update_post = mysqli_query($connection, $query);
			confirm_query($update_post);

			// Message for user
			echo '<div class="alert alert-success"><b>Your comment has been submitted. We will review it shortly.</b></div>';
		} else{
			echo "<script>alert('Fields cannot be empty');</script>";
		}
	}
}


function display_users(){
	global $connection;

    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query); 

    while ($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_img = $row['user_img'];
        $user_role = $row['user_role'];
        $user_registration = $row['user_registration'];
        $randSalt = $row['randSalt'];
		
		// $query = "SELECT * FROM posts WHERE post_id = {$username}";
		// $select_post = mysqli_query($connection, $query);
		// confirm_query($select_post);
		// $post_selected = mysqli_fetch_assoc($select_post);
		// $post_category_id = $post_selected['post_id'];
		// $post_category_title = $post_selected['post_title'];


        echo "<tr>
	    		<td>{$user_id}</td>
	    		<td>{$username}<br><img src='../img/{$user_img}'' alt='{$username}' height=30></td>
	    		<td>{$user_firstname}</td>
	    		<td>{$user_lastname}</td>
	    		<td>{$user_email}</td>
	    		<td>{$user_role}</td>
	    		<td>{$user_registration}</td>
	    		<td><a href='users.php?toAdmin={$user_id}'>Admin</a></td>
	    		<td><a href='users.php?toSubscriber={$user_id}'>Subscriber</a></td>
	    		<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>
	    		<td><a onclick=\"return confirm('Are you sure you want to delete the user with id {$user_id}?')\" href='users.php?delete={$user_id}'>Delete</a></td>
			</tr>";
	}
}

function insert_users(){

	global $connection, $hashed_password;
	
	if(isset($_POST['create_user'])){

		$username = $_POST['username'];
		$user_password = mysqli_escape_string($connection, $_POST['user_password']);
		// Encrypt the password
		encrypt_password($user_password);
		$user_firstname = $_POST['user_firstname'];
		$user_lastname = $_POST['user_lastname'];
		$user_email = $_POST['user_email'];
		// We need to use the super globals $_FILES and a temporary location
		$user_img = $_FILES['user_img']['name'];
		$user_img_tmp = $_FILES['user_img']['tmp_name'];
		$user_role = $_POST['user_role'];
		$user_registration = $_POST['user_registration'];
		
		// move_uploaded_file(filename, destination)
		move_uploaded_file($user_img_tmp, "img/$user_img");
		
		$query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_img, user_role, user_registration) ";
		$query .= "VALUES('{$username}', '{$hashed_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_img}', '{$user_role}', now())";

		$query_add_user = mysqli_query($connection, $query);
        
        confirm_query($query_add_user);

        // I want to go to view all post after insertion
	    header("Location: users.php");
	}

}

function delete_users(){
	global $connection;

	if(isset($_GET['delete'])){
	    $delete = $_GET['delete'];
	    $query = "DELETE FROM users WHERE user_id={$delete}";
	    $delete_user = mysqli_query($connection, $query);
	    confirm_query($delete_user); 
	    // To refresh the page : it avoids manually refreshes
	    header("Location: users.php");
	}
}

function change_to_admin(){
	global $connection;

	if(isset($_GET['toAdmin'])){
	    $user_id = $_GET['toAdmin'];
	    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$user_id}";
	    $update_role = mysqli_query($connection, $query);
	    confirm_query($update_role); 
	    // To refresh the page : it avoids manually refreshes
	    header("Location: users.php");
	}
}

function change_to_subscriber(){
	global $connection;

	if(isset($_GET['toSubscriber'])){
	    $user_id = $_GET['toSubscriber'];
	    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$user_id}";
	    $update_role = mysqli_query($connection, $query);
	    confirm_query($update_role); 
	    // To refresh the page : it avoids manually refreshes
	    header("Location: users.php");
	}
}

function edit_user(){
	global $connection, $user_firstname, $user_lastname, $username, $user_email, $db_user_password, $user_role, $user_img, $message;

	if(isset($_GET['user_id'])){
	    $user_id = $_GET['user_id'];
	    $query = "SELECT * FROM users WHERE user_id={$user_id}";
	    $select_user = mysqli_query($connection, $query);
	    confirm_query($select_user);
	    $user = mysqli_fetch_assoc($select_user);
        $user_firstname = $user['user_firstname'];
        $user_lastname = $user['user_lastname'];
        $username = $user['username'];
        $user_email = $user['user_email'];
        $db_user_password = $user['user_password'];
        $user_role = $user['user_role'];
        $user_img = $user['user_img'];
        $user_randSalt = $user['randSalt'];
	}

	if(isset($_POST['update_user'])){

		$user_firstname = $_POST['user_firstname'];
		$user_lastname = $_POST['user_lastname'];
		$username = $_POST['username'];
		$user_email = $_POST['user_email'];
		$user_img = $_FILES['user_img']['name'];
		$user_img_tmp = $_FILES['user_img']['tmp_name'];
		$user_password = mysqli_escape_string($connection, $_POST['user_password']);
		//Encrypt the password if the user changes it
		if($db_user_password !== $user_password){
			$db_user_password = crypt($user_password, $user_randSalt);
		}
		$user_role = $_POST['user_role'];

	    // move_uploaded_file(filename, destination)
		move_uploaded_file($user_img_tmp, "../img/$user_img");
		
		// if we don't change the image or it's empty
		if(empty($user_img)){

			$query = "SELECT * FROM users WHERE user_id = $user_id";
			$select_image = mysqli_query($connection, $query);
			confirm_query($select_image);
			
			$user_selected = mysqli_fetch_assoc($select_image);
			$user_img = $user_selected['user_img'];
		}
		
		$query = "UPDATE users SET ";
		$query .= "user_firstname = '{$user_firstname}', ";
		$query .= "user_lastname = '{$user_lastname}', ";
		$query .= "username = '{$username}', ";
		$query .= "user_email = '{$user_email}', ";
		$query .= "user_img = '{$user_img}', ";
		$query .= "user_password = '{$db_user_password}', ";
		$query .= "user_role = '{$user_role}' ";
		$query .= "WHERE user_id = {$user_id}";
		
		$update_user = mysqli_query($connection, $query);
		confirm_query($update_user);

		//Message for the Admin
		echo "<div class='alert alert-success'>
    		<p><strong>User updated successfully</strong></p>
    		<p><a href='users.php'>Edit More Users</a></p>
    		</div>";
	}
}

function edit_profile(){
	global $connection, $user_firstname, $user_lastname, $username, $user_email, $db_user_password, $user_img, $message;

	if(isset($_SESSION['user_id'])){
	    $user_id = $_SESSION['user_id'];
	    $query = "SELECT * FROM users WHERE user_id={$user_id}";
	    $select_user = mysqli_query($connection, $query);
	    confirm_query($select_user);
	    $user = mysqli_fetch_assoc($select_user);
        $user_firstname = $user['user_firstname'];
        $user_lastname = $user['user_lastname'];
        $username = $user['username'];
        $user_email = $user['user_email'];
        $db_user_password = $user['user_password'];
        $user_role = $user['user_role'];
        $user_img = $user['user_img'];
        $user_randSalt = $user['randSalt'];
	}

	if(isset($_POST['update_profile'])){

		$user_firstname = $_POST['user_firstname'];
		$user_lastname = $_POST['user_lastname'];
		$username = $_POST['username'];
		$user_email = $_POST['user_email'];
		$user_img = $_FILES['user_img']['name'];
		$user_img_tmp = $_FILES['user_img']['tmp_name'];
		$user_password = mysqli_escape_string($connection, $_POST['user_password']);
		//Encrypt the password if the user changes it
		if($db_user_password !== $user_password){
			$db_user_password = crypt($user_password, $user_randSalt);
		}

	    // move_uploaded_file(filename, destination)
		move_uploaded_file($user_img_tmp, "../img/$user_img");
		
		// if we don't change the image or it's empty
		if(empty($user_img)){

			$query = "SELECT * FROM users WHERE user_id = $user_id";
			$select_image = mysqli_query($connection, $query);
			confirm_query($select_image);
			
			$user_selected = mysqli_fetch_assoc($select_image);
			$user_img = $user_selected['user_img'];
		}
		
		$query = "UPDATE users SET ";
		$query .= "user_firstname = '{$user_firstname}', ";
		$query .= "user_lastname = '{$user_lastname}', ";
		$query .= "username = '{$username}', ";
		$query .= "user_email = '{$user_email}', ";
		$query .= "user_img = '{$user_img}', ";
		$query .= "user_password = '{$db_user_password}' ";
		$query .= "WHERE user_id = {$user_id}";
		
		$update_user = mysqli_query($connection, $query);
		confirm_query($update_user);
		//Message for the user
		$message = '<div class="alert alert-success">Your Profile has been updated successfully.</div>';
	}else{
		$message = '';
	}
}

function count_data($tableDB, $optWhere = ''){
	global $connection;
	$query = "SELECT * FROM $tableDB $optWhere";
	$count_rows = mysqli_query($connection, $query);
	confirm_query($count_rows);
	$count = mysqli_num_rows($count_rows);
	return $count;
}

function register_user(){
	global $connection, $message, $hashed_password;
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
	        encrypt_password($password);

	        $query = "INSERT INTO users(username, user_password, user_email, user_role) ";
	        $query .= "VALUES ('$username', '$hashed_password', '$email', 'subscriber')";
	        $newUser = mysqli_query($connection, $query);
	        confirm_query($newUser);
	        //Message for the user
	        $message = '<div class="alert alert-success">Your Registration has been submitted.</div>';
	    } else {
	        //Alert with JS
	        $message = '<script>alert("Fields cannot be empty!")</script>';
	    }
	}
}

function encrypt_password($password){
	global $connection, $hashed_password;
	$query = "SELECT randSalt FROM users";
	$getSalt = mysqli_query($connection, $query);
	confirm_query($getSalt);
	$row = mysqli_fetch_array($getSalt);
	//If the randSalt were empty, it would take the default value added into the DB
	$salt = $row['randSalt'];
	//Apply the crypt function
	$hashed_password = crypt($password, $salt);
}

?>