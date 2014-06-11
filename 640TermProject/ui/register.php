<?php
include('header.php');
?>

<?php
if(!empty($_SESSION['logged_in'])){
	echo "<h1>Error</h1>";
	echo "<p>You are already registered and logged in. Redirecting to front page.";
	include('footer.php');
	echo '<meta http-equiv="refresh" content="0;url=index.php" />';
	exit();
}

$showForm = true;
if(!empty($_POST)){
	// Handle incoming data
	$showForm = false;

	// Assign data
	$firstname = $_POST['first_name'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password1 = $_POST['password'];
	$password2 = $_POST['password_repeat'];

	// Check for empty input
	if(empty($firstname) || empty($username) || empty($email) || empty($password1) || empty($password2)){
		echo '<p class="alert alert-warning">You need to fill out all the fields. Please try again</p>';
		$showForm = true;
	}

	// Check passwords
	if($password1 != $password2){
		echo '<p class="alert alert-warning">Your passwords don\'t match. Please try again</p>';
		$showForm = true;
	}

	// TODO: Implement email checks as well

	// Try to save the user
	if(!$showForm){
		if(!UserHandler::checkIfEmailExists($email) && !UserHandler::checkIfUsernameExists($username)){
			$newUser = new User(0, $firstname, $username, $email, $password1, 0);
			$insertedID = UserHandler::insertUser($newUser);

			if($insertedID > 0){
				echo '<p class="alert alert-success">Thank you for registering! Please <a href="login.php">log in</a></p>';
			} else {
				echo '<p class="alert alert-warning">Couldn\'t register at this time. Please try again later.</p>';
			}
		} else {
			echo '<p class="alert alert-danger">A user with this email address or username already exist!</p>';
			$showForm = true;
		}
	}
}
if($showForm){
	echo '

	<h1>Register a new account</h1>

	<p>* All fields are required.</p>

	<div class="row">
		<div id="registration-form" class="col-md-8">
			<form class="form-horizontal" id="register-form" name="register-form" role="form" method="post" action="register.php">
				<div class="form-group">
					<label for="first_name" class="col-sm-2 control-label">First Name *</label>
					<div class="col-sm-10">
						<input required type="text" class="form-control" name="first_name" id="first_name" maxlength="30" placeholder="John">
					</div>
				</div>

				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email *</label>
					<div class="col-sm-10">
						<input required type="email" class="form-control" name="email" id="email" maxlength="70" placeholder="jdoe@acme.com">
					</div>
				</div>

				<div class="form-group">
					<label for="username" class="col-sm-2 control-label">Username *</label>
					<div class="col-sm-10">
						<input required type="text" class="form-control" name="username" id="username" maxlength="30" placeholder="Joe5764">
					</div>
				</div>

				<div class="form-group">
					<label for="inputPassword1" class="col-sm-2 control-label">Password *</label>
					<div class="col-sm-10">
						<input required type="password" class="form-control" name="password" id="inputPassword1" maxlength="40" placeholder="A secure password">
					</div>
				</div>

				<div class="form-group">
					<label for="inputPassword2" class="col-sm-2 control-label">Confirm Password *</label>
					<div class="col-sm-10">
						<input required type="password" class="form-control" name="password_repeat" id="inputPassword2" maxlength="40" placeholder="Re-enter password">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default pull-right">Register</button>
					</div>
				</div>
			</form>
		</div>

		<div id="help-box" class="col-md-4">
			<!-- Help box -->
			<p>Your first name will only be used to identify you and will not be shared with anyone.</p>
			<p>Your email address will be used to contact you with updates and messages from the site. This email will be used for communicating with other users.</p>
			<p>Your username is used for logging in to the site and can be seen by other users.</p>
		</div>
	</div>';

}
?>


<?php
include('footer.php');
?>
