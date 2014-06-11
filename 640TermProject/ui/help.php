<?php
include('header.php');
include('searchbar.php');
?>
<script src="js/message_limit.js"></script>

<h4><a href='index.php'>&laquo; Back to Home</a></h4>

<h1>Help</h1>

<h3>This site is for demonstration purposes only.</h3>

<hr>

<!-- FAQ -->
<h3>Frequently Asked Questions (FAQ)</h3>
<h4><a href='#1'>What is SwiftThrift?</a></h4>
<h4><a href='#2'>Why can't I access certain parts of the site?</a></h4>
<h4><a href='#3'>How does buying work?</a></h4>
<h4><a href='#4'>Why can't I find my listing?</a></h4>
<h4><a href='#contact'>&#9658; Contact Us</a></h4>
<br>

<h4 id='1'>What is SwiftThrift?</h4>
<p>SwiftThrift is a site developed for a Software Engineering class project at San Francisco State University.<br>
Our site's purpose is to increase a local newspaper's revenue stream by replacing its' classifieds with an online marketplace.<br>
Our site stands out from others by focusing on a simple design with great usability.</p>
<p><a href='#'>&uArr; Back to top</a></p>
<br>

<h4 id='2'>Why can't I access certain parts of the site?</h4>
<p>You must have an account and be logged-in to use the 'Buy' and 'Sell' functions of the site.</p>
<p><a href='#'>&uArr; Back to top</a></p>
<br>

<h4 id='3'>How does buying work?</h4>
<p>When you click 'Buy' you will be directed to a 'Contact Seller' form, where you can express your interest to buy an item.<br>
Note that this site does not handle any transactions. All transactions are to be negotiated between the buyer and seller.</p>
<p><a href='#'>&uArr; Back to top</a></p>
<br>

<h4 id='4'>Why can't I find my listing?</h4>
<p>Listings must be reviewed by an admin and approved before they are listed on the site.<br>
You'll receive an email from us with a link to your item once it's been approved. You can also track all of your listings on <a href="http://sfsuswe.com/~s14g01/account.php">your account page.</a></p>
<p><a href='#'>&uArr; Back to top</a></p>

<hr>

<h3 id='contact'>Contact Us</h3>

<!-- Instructions for the user -->
<h4>Have a question not addressed by the FAQ or need help with something else?<br>
Use the form below to send us your questions and comments!</h4>

<!-- Contact form -->
<div class='row'>
	<div class='panel panel-default col-sm-8' id='contactForm'>
		<?php
		if (!isset($_POST['submit'])) {
		?>
		

		<form class='form-horizontal' method='post' action='<?php echo $_SERVER["PHP_SELF"]."#contact"; ?>' role='form'>
			<!-- Message Form -->
			<div class='form-group'>
				<label for='firstname' class='col-sm-2 control-label text-right'>Name: </label>
				<div class='col-sm-4'>
					<input required type='text' class='form-control' name='firstname' id='firstname' maxlength='30' placeholder='John'>
				</div>
			</div>

			<div class='form-group'>
				<label for='email' class='col-sm-2 control-label text-right'>Email: </label>
				<div class='col-sm-4'>
					<input required type='email' class='form-control' name='email' id='email' maxlength='70' placeholder='jdoe@acme.com'>
				</div>
			</div>

			<div class='form-group'>
				<label for='subject' class='col-sm-2 control-label text-right'>Subject: </label>
				<div class='col-sm-8'>
					<input required type='text' class='form-control' name='subject' id='subject' maxlength='100' placeholder='Account Problems, Listing Issues, etc.'>
					<p>(max. 100 characters)</p>
				</div>
			</div>

			<div class='form-group'>
				<label for='message' class='col-sm-2 control-label text-right'>Message: </label>
				<div class='col-sm-8'>
					<textarea required class='form-control' rows='5' cols='50' name='message' id='message' maxlength='1500' placeholder='Start typing your message here.'></textarea>
					<p id='characters'></p> <!-- character limit counter -->
				</div>
			</div>

			<div class='form-group'>
				<div class='col-sm-offset-2 col-sm-8'>
					<button type='reset' class='btn btn-default pull-left'>Clear Form</button>
					<button type='submit' name='submit' class='btn btn-primary pull-right'>Send Message</button>
				</div>
			</div>
		</form>
		<?php
		} else {
			$from = "ksooho@sfsuswe.com";
			$subject = "SwiftThrift - Contact Us from: " . $_POST['firstname'];

			$message = "Hello, SwiftThrift admin.\n" . 
					   "A user has sent you a message using your contact form.\n\n" . 
					   "From: \"" . $_POST['firstname'] . "\" <" . $_POST['email'] . ">\n" . 
					   "Subject: " . $_POST['subject'] . "\n" . 
			           "====================\n";
			$message .= $_POST['message'];
			$message .= "\n====================\n\n";
			$message .= "http://sfsuswe.com/~s14g01/\n";
			$message .= "- The SwiftThrift Team";
			$message = wordwrap($message, 70);

			mail("s14g01list@sfsuswe.com", $subject, $message, "From: $from\n");

			echo "<p class='lead text-center'>Your message has been sent!</p>";
		} ?>
	</div>
</div>
<p><a href='#'>&uArr; Back to top</a></p>

<?php
include('footer.php');
?>

