<?php include "db.php"; ?>
<!-- Start Session -->
<?php session_start(); ?>
<?php include "../admin/functions.php"; ?>

<?php 

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$user_password = $_POST['user_password'];

	// Clear data for hackers
	$username = mysqli_real_escape_string($connection, $username);
	$user_password =mysqli_real_escape_string($connection, $user_password);

	$query = "SELECT * FROM users WHERE username = '{$username}'";
	$select_user = mysqli_query($connection, $query);
	confirm_query($select_user);
	$user = mysqli_fetch_assoc($select_user);
	$db_user_id = $user['user_id'];
	$db_username = $user['username'];
	$db_user_password = $user['user_password'];
	$db_user_firstname = $user['user_firstname'];
	$db_user_lastname = $user['user_lastname'];
	$db_user_role = $user['user_role'];
	// $user_email = $user['user_email'];
	// $user_img = $user['user_img'];
	// $user_registration = $user['user_registration'];
	// $randSalt = $user['randSalt'];

	if ($username === $db_username && $user_password === $db_user_password) {
		// Set up session
		$_SESSION['user_id'] = $db_user_id;
		$_SESSION['username'] = $db_username;
		$_SESSION['user_firstname'] = $db_user_firstname;
		$_SESSION['user_lastname'] = $db_user_lastname;
		$_SESSION['user_role'] = $db_user_role;

		header("Location: ../admin");
	} else{
		header("Location: ../index.php");
	}
}

?>