<?php
include('header.php');
?>
<script src="js/message_limit.js"></script>
<?php

$id = (int) @$_GET['item'];

if(!empty($id) && is_numeric($id) && $id >= 1) {
	$item = ItemHandler::getUnpublishedItemWithId($id);
} else {
	$item = null;
}
?>

<?php
if($item != null) {
	$seller = UserHandler::getUserWithId((int) $item->getSellerId());
?>

<?php
if(empty($_SESSION['logged_in'])){
	echo "<meta http-equiv='refresh' content='0;url=login.php?r=send_message.php?item={$item->getId()}'/>";
	exit();
}
?>

<h4><a href='detailed.php?item=<?php echo $item->getId(); ?>'>&laquo; Back to Detailed View</a></h4>

<div class='panel panel-default'>
	<div class='panel-heading'>
		<h2>Contact Seller</h2>
	</div>

	<div class='panel-body'>

		<div class='alert alert-info'>
			<strong>Notice:</strong> This site does not handle any transactions. All transactions are to be negotiated between the buyer and seller.
		</div>

		<?php
		if (!isset($_POST['submit'])) {
		?>
		<!-- Instructions for the user -->
		<h4><strong>
			Use the form below to contact the seller with your questions or interest to buy.
		</strong></h4>

		<form method='post' action='<?php echo $_SERVER["PHP_SELF"]."?item=".$id;?>' role='form'>
			<!-- Message Form -->
			<div class='form-group'>
				<label class='col-sm-2 control-label text-right'>Item: </label>
				<div class='col-sm-10'>
					<p><?php echo $item->getTitle(); ?></p>
				</div>
			</div>

			<div class='form-group'>
				<label class='col-sm-2 control-label text-right'>Price: </label>
				<div class='col-sm-10'>
					<p><?php echo $item->getPrice(); ?></p>
				</div>
			</div>

			<div class='form-group'>
				<label class='col-sm-2 control-label text-right'>Seller: </label>
				<div class='col-sm-10'>
					<p><?php echo $seller->getUsername(); ?></p>
				</div>
			</div>

			<?php // Checks if user is the seller
			if($item->getSellerId() == $_SESSION['user']->getId()) {
				echo "
				<div class='col-sm-6'>
					<p class='lead text-center'><strong>This is your Item!</strong></p>
				</div>
				";
			} else { // Seller is not logged-in user
			?>

			<div class='form-group'>
				<label for='message' class='col-sm-2 control-label text-right'>Message: </label>
				<div class='col-sm-6'>
					<textarea required class='form-control' rows='5' cols='50' name='message' id='message' maxlength='1500' placeholder='Start typing your message here.'></textarea>
					<p id='characters'></p> <!-- character limit counter -->
				</div>
			</div>

			<div class='row'>
				<div class='col-sm-offset-2 col-sm-6'>
					<div class='alert alert-info'>
						When you click <strong>Send Message</strong>, your username and e-mail will be sent along with your message.
					</div>
				</div>
			</div>

			<div class='form-group'>
				<div class='col-sm-offset-2 col-sm-6'>
					<button type='reset' class='btn btn-default pull-left'>Clear Form</button>
					<button type='submit' name='submit' class='btn btn-primary pull-right'>Send Message</button>
				</div>
			</div>

			<?php // End of else for seller check
			}
			?>
		</form>
		<?php
		} else {
			$from = "swiftthrift-noreply@sfsuswe.com";
			$subject = "SwiftThrift - Inquiry for listing: " . $item->getTitle();

			$message = "Hello, " . $seller->getUsername() . "\n" . 
					   "Thank you for using SwiftThrift.\n\n" . 
					   "You have received a message regarding your listing for: " . $item->getTitle() . "\n" . 
					   "Click the URL below, or copy and paste it into your address bar to view this listing.\n" . 
					   "http://sfsuswe.com/~s14g01/detailed.php?item={$id}\n\n" . 
			           "From: \"" . $_SESSION['user']->getUsername() . "\" <" . $_SESSION['user']->getEmail() . ">\n" . 
			           "====================\n";
			$message .= $_POST['message'];
			$message .= "\n====================\n\n";
			$message .= "If you have any questions or concerns, please contact us using the form here:\n";
			$message .= "http://sfsuswe.com/~s14g01/help.php#contact\n\n";
			$message .= "- The SwiftThrift Team";
			$message = wordwrap($message, 70);

			mail($seller->getEmail(), $subject, $message, "From: $from\nReply-To: {$_SESSION['user']->getEmail()}");
			
			echo "<p class='lead text-center'>Your message has been sent!</p>";
		} ?>
	</div>
</div>

<?php
} else { // If an invalid item id is entered
?>
<h4><a href='index.php'>&laquo; Back to Home</a></h4>

<div class='panel panel-default'>
	<div class='panel-heading'>
		<h2>Contact Seller</h2>
	</div>

	<div class='panel-body'>
		<p class='lead text-center'>Listing not found. Please go back and try again.</p>
	</div>
</div>
<?php
}
?>

<?php
include('footer.php');
?>
