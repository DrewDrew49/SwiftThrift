<?php
include('header.php');
?>
<script src="js/tabs.js"></script>
<script src="js/publish.js"></script>
<?php
	if(empty($_SESSION['logged_in'])) {
		echo "<meta http-equiv='refresh' content='0;url=login.php?r=account.php'/>";
		exit();
	} else {
		echo "<h4><a href='index.php'>&laquo; Back to Home</a></h4>";

		echo "<h1>Welcome {$_SESSION['user']->getFirstName()}!</h1>
		<span class='pull-right'>
			<a href='sell.php' class='btn btn-primary'>Sell an Item</a>
			<button type='submit' class='btn btn-default' id='refresh'><i class='glyphicon glyphicon-refresh'></i> Refresh</button>
		</span>";


		if (empty($_POST)) {
		echo "
		<ul class='nav nav-tabs' id='tabs'>
			<li class='active'><a href='#posts' data-toggle='tab'>My Listings</a></li>
			<li><a href='#info' data-toggle='tab'>Account Information</a></li>
		</ul>

		<div class='tab-content'>";
		} else {
		echo "
		<ul class='nav nav-tabs' id='tabs'>
			<li><a href='#posts' data-toggle='tab'>My Listings</a></li>
			<li class='active'><a href='#info' data-toggle='tab'>Account Information</a></li>
		</ul>
		
		<div class='tab-content'>";
		}

			// begin My Listings tab
			if (empty($_POST)) {
			echo "
			<div class='tab-pane active' id='posts'>
				<ul>";
			} else {
			echo "
			<div class='tab-pane' id='posts'>
				<ul>";
			}

				//gets user's items, displays them and lets user know if it's published or not, gives them option to delete listing,
				
				$userItems = ItemHandler::getItemsForSellerId($_SESSION['user']->getId());
				$numItems = count($userItems);

				if($numItems > 0){
					echo "<br><p id='numItemsText'>You currently have <span id='numItems'>{$numItems}</span> item(s) listed, here they are!</p>";
				}

				echo "<div id='tableHolder' class='table-responsive'>";

				if(empty($userItems)){
					echo '<p class="lead text-center">You currently have no items listed</p>';
				} else {
					echo '<table class="table" id="userListings">

					<tr>
					<th>Image</th>
					<th>Item Name</th>
					<th>Description</th>
					<th>Price</th>
					<th>Date Posted</th>
					<th>Status</th>
					<th></th>
					</tr>';

					/*-- published status, 1 for yes, 0 for no, echo result in table data--*/
					//why can't we call getters on items here?
					foreach($userItems as $item){

						$shortDescription = substr($item['description'], 0, 200);
						if(strlen($item['description']) > 200){
							$shortDescription .= "..." . "<a href='detailed.php?item={$item['id']}'> Read More</a>";
						}

						echo "<tr>
						<td><a href='detailed.php?item={$item['id']}'><img width='140' src='{$item['imgPath']}'' alt='Image' class='img-thumbnail' /></a></td>
						<td><a href='detailed.php?item={$item['id']}'>{$item['title']}</a></td>
						<td>$shortDescription</td>
						<td>{$item['price']}</td>
						<td>{$item['postedTS']}</td>
						<td>". ( ($item['published'] == 1) ? "Published" : "Unpublished" ) ."</td>";
						echo "<td><button type='button' name='deleteItem' id='{$item['id']}' class='btn btn-danger'>Delete</button></td>";
						echo "</tr>";
					}

					echo '</table> </div>';
				}
			echo "
				</ul>
			</div>";
			// end My Listings tab

			// begin Account info tab
			if (empty($_POST)) {
			echo "
			<div class='tab-pane' id='info'>
				<ul>";
			} else {
			echo "
			<div class='tab-pane active' id='info'>
				<ul>";
			}

					echo "
					<h3>Edit your account information</h3>";

					// validates input and updates user info
					if(!empty($_POST)){
						// data
						$user = $_SESSION['user'];
						$currentPassword = $_POST['password'];
						$firstname = $_POST['newFirstName'];
						$email = $_POST['newEmail'];
						$password1 = $_POST['newPassword'];
						$password2 = $_POST['newPasswordRepeat'];

						if ($user->getPassword() != Utils::saltAndHash($currentPassword)) {
							echo "<p class='alert alert-danger'>Your current password is incorrect. Please try again.</p>";
						} else {
							// first name check and update
							if (!empty($firstname)) {
								$oldname = $user->getFirstName();
								$user->setFirstName($firstname);
								if (UserHandler::updateInfoForUserWithId((int)$user->getId(), $user)) {
									echo "<p class='alert alert-success'>Your first name has been updated!</p>";
								} else {
									$user->setFirstName($oldname);
									echo "<p class='alert alert-info'><strong>Error:</strong> Your first name could not be updated. Please try again later.</p>";
								}
							}
							// email check and update
							if (!empty($email)) {
								if (UserHandler::checkIfEmailExists($email)) {
									echo "<p class='alert alert-warning'>The email you've entered is already in use. Please try another email.</p>";	
								} else {
									$oldemail = $user->getEmail();
									$user->setEmail($email);
									if (UserHandler::updateInfoForUserWithId((int)$user->getId(), $user)) {
										echo "<p class='alert alert-success'>Your email has been updated!</p>";
									} else {
										$user->setEmail($oldemail);
										echo "<p class='alert alert-info'><strong>Error:</strong> Your email could not be updated. Please try again later.</p>";
									}
								}
							}
							// password check and update
							if ($password1 != $password2) {
								echo "<p class='alert alert-warning'>Your new passwords don't match. Please try again.</p>";
							} elseif (!empty($password1) && !empty($password2)) {
								$oldpassword = $user->getPassword();
								$user->setPassword($password1);
								if (UserHandler::updateInfoForUserWithId((int)$user->getId(), $user)) {
									echo "<p class='alert alert-success'>Your password has been updated!</p>";
								} else {
									$user->setPassword($oldpassword);
									echo "<p class='alert alert-info'><strong>Error:</strong> Your password could not be updated. Please try again later.</p>";
								}
							}
						}
					}

					// edit user info form
					echo "
					<p>* Required to make changes.</p>
					<div class='row'>
						<div id='edit-info-form' class='col-md-8'>
							<form class='form-horizontal' id='edit-form' name='edit-form' role='form' method='post' action='account.php#info'>

							<div class='form-group'>
								<label for='currentPassword' class='col-sm-2 control-label'>Current Password *</label>
								<div class='col-sm-10'>
									<input required type='password' class='form-control' name='password' id='currentPassword' maxlength='40' placeholder=''>
								</div>
							</div>

							<hr>

							<div class='form-group'>
								<label for='firstName' class='col-sm-2 control-label'>First Name</label>
								<div class='col-sm-10'>
									<p class='account-info' id='firstName'>{$_SESSION["user"]->getFirstName()}</p>
								</div>
							</div>

							<div class='form-group'>
								<label for='newFirstName' class='col-sm-2 control-label'>New First Name</label>
								<div class='col-sm-10'>
									<input type='text' class='form-control' name='newFirstName' id='newFirstName' maxlength='30' placeholder=''>
								</div>
							</div>

							<hr>

							<div class='form-group'>
								<label for='email' class='col-sm-2 control-label'>Email</label>
								<div class='col-sm-10'>
									<p class='account-info' id='email'>{$_SESSION["user"]->getEmail()}</p>
								</div>
							</div>

							<div class='form-group'>
								<label for='newEmail' class='col-sm-2 control-label'>New Email</label>
								<div class='col-sm-10'>
									<input type='email' class='form-control' name='newEmail' id='newEmail' maxlength='70' placeholder=''>
								</div>
							</div>

							<hr>

							<div class='form-group'>
								<label for='inputPassword1' class='col-sm-2 control-label'>New Password</label>
								<div class='col-sm-10'>
									<input type='password' class='form-control' name='newPassword' id='inputPassword1' maxlength='40' placeholder='Your new secure password'>
								</div>
							</div>

							<div class='form-group'>
								<label for='inputPassword2' class='col-sm-2 control-label'>Confirm New Password</label>
								<div class='col-sm-10'>
									<input type='password' class='form-control' name='newPasswordRepeat' id='inputPassword2' maxlength='40' placeholder='Re-enter your new password'>
								</div>
							</div>

							<div class='form-group'>
								<div class='col-sm-offset-2 col-sm-10'>
									<button type='reset' class='btn btn-default pull-left'>Clear Fields</button>
									<button type='submit' class='btn btn-primary pull-right'>Save Changes</button>
								</div>
							</div>

							</form>
						</div>

						<div id='help-box' class='col-md-4'>
							<p>Your current password is required to make any changes to your information.</p>
						</div>
					</div>
				</ul>
			</div>";
			// end Account info tab
		
		echo "
		</div>";
	}

?>

<?php
include('footer.php')
?>
