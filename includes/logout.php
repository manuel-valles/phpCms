<!-- Start Session -->
<?php session_start(); ?>

<?php 
	// Cancel the session
	$_SESSION['username'] = null;
	$_SESSION['user_firstname'] = null;
	$_SESSION['user_lastname'] = null;
	$_SESSION['user_role'] = null;
	// Send back to index
	header("Location: ../index.php");
?>