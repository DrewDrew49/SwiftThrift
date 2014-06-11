<?php
include('header.php');


if(!empty($_SESSION['logged_in'])){
	session_destroy();
	echo '<p class="alert alert-success">You have been logged out! You\'ll be redirected in 3 seconds. <a href="index.php">Click here if you do not wish to wait.</a></p>';
	echo '<meta http-equiv="refresh" content="3;url=index.php" />';
} else {
	echo '<p class="alert alert-danger">You are not logged in, so we can\'t log you out. You\'ll be redirected in 3 seconds. <a href="index.php">Click here if you do not wish to wait.</a></p>';
	echo '<meta http-equiv="refresh" content="3;url=index.php" />';
}


include('footer.php');
?>
