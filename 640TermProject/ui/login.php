<?php
include('header.php');

$showRow = true;

if(!empty($_POST)){
	$showRow = false;

	$username = $_POST['username'];
	$password = $_POST['password'];

	$userObject = UserHandler::getUserWithUsername($username);

	if(!$userObject || $userObject->getPassword() != Utils::saltAndHash($password)){
		echo '<p class="alert alert-warning">Either invalid username or password. Please try again.</p>';
		$showRow = true;
	} else {
		$_SESSION['logged_in'] = true;
		$_SESSION['user'] = $userObject;

		echo "<p class='alert alert-success'>Thank you for logging in! You'll be redirected in 3 seconds. ";
		// If we have a specific page to redirect to
		if(!empty($_GET['r'])){
			$page = $_GET['r'];
			echo "<a href='{$page}'>Click here if you do not wish to wait.</a></p>
				  <meta http-equiv=\"refresh\" content=\"3;url=$page\" />";
		} else {
			echo '<a href="index.php">Click here if you do not wish to wait.</a></p>
				  <meta http-equiv="refresh" content="3;url=index.php" />';	
		}
		
	}

}

if($showRow && empty($_SESSION['logged_in'])){
echo '<!-- Even -->
<div class="row">
	<!-- Login -->
	<div class="col-md-6">

		<h2>Log in</h2>

		<form class="form-horizontal" role="form" method="post" action="'; echo $_SERVER['REQUEST_URI']; echo '">
			<div class="form-group">
				<label for="username" class="col-sm-2 control-label">Username</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="username" id="username" maxlength="30" placeholder="Your username">
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-sm-2 control-label">Password</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" name="password" id="password" maxlength="40" placeholder="Your password">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<p><small>We\'ll remember you until you log out manually.</small></p>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default pull-right">Log in</button>
				</div>
			</div>
		</form>

	</div>

	<!-- Register -->
	<div class="col-md-6">
		<h2>New user</h2>
		<h4 class="text-center">Don\'t have an account yet?</h4>
		<p class="text-center">
			<a href="register.php" class="btn btn-primary btn-lg">Register</a>
		</p>
	</div>
</div>';
}if ($showRow && !empty($_SESSION['logged_in'])) {
	echo "<p>You're already logged in as {$_SESSION['user']->getUsername()}, ";
	echo '<a href="logout.php">Log out?</a></p>';
}
?>

<?php
include('footer.php');
?>
