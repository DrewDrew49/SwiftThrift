<?php
include('header.php');
?>

<h4><a href="index.php">&laquo; Back to Home</a></h4>

<?php
$showForm = true;

if(empty($_SESSION['logged_in'])){
	echo '<meta http-equiv="refresh" content="0;url=login.php?r=sell.php" />';
	exit();
}

if(!empty($_POST)){
	// Handle incoming data
	$showForm = false;

	// Assign data
	$title = $_POST['item_name'];
	$description = $_POST['item_description'];
	$price = $_POST['item_price'];
	$keywords = $_POST['item_keywords'];
	$posted_on = date('m/d/Y h:i:s a');
	if(isset($_POST['item_category'])){
		$category = (int) $_POST['item_category'];
	}
	$keywords = $_POST['item_keywords'];
	$imageFile = $_FILES;

	// Check for empty input
	if(empty($title) || empty($description) || empty($price) || empty($keywords) || empty($category) || empty($_FILES)){
		echo '<p class="alert alert-warning"><strong>Incomplete:</strong> You need to fill out all the fields. Please check all fields and try again.</p>';
		$showForm = true;
	} elseif(!is_numeric($price) || $price < 0 || $price > 99999.99) {
		echo '<p class="alert alert-warning"><strong>Invalid input:</strong> Price must be a number within $0.00 and $99999.99. Please try again.</p>';
		$showForm = true;
	}

	// Try to save the item need to make keywords a col. in database for items
	if(!$showForm){
		$imageHandling = Utils::handleImage($imageFile);

		if(!$imageHandling){
			echo '<p class="alert alert-info"><strong>Error:</strong> Couldn\'t upload your picture at this time. Please try again later.</p>';
		} else {

			$newItem = new Item(0, $title, $description, $imageHandling, $category, $keywords, $posted_on, null, $price, false, $_SESSION['user']->getId());

			$insertedID = ItemHandler::insertItem($newItem);

			if($insertedID > 0){
				echo '<p class="alert alert-success">Thank you for listing your item! <a href="sell.php">Sell another one?</a></p>
					  <p class="alert alert-info"><strong>Notice:</strong> Your listing will be reviewed by an admin and we\'ll email you once it\'s been approved! 
					  Track your listings <a href="account.php">here.</a></p>';
			} else {
				echo '<p class="alert alert-info"><strong>Error:</strong> Couldn\'t list item at this time. Please try again later.</p>';
			}
		}
	}
}

if($showForm){
	echo '
	<h1>Sell an Item</h1>
	<div class="alert alert-info">
		<strong>Notice:</strong> This site does not handle any transactions. All transactions are to be negotiated between the buyer and seller.
	</div>

	<p>* All fields are required.</p>

	<div class="row">
		<div id="item-form" class="col-md-8">
			<form class="form-horizontal" id="item-form" name="item-form" role="form" method="post" enctype="multipart/form-data" action="sell.php">

				<div class="form-group">
					<label for="item_name" class="col-sm-2 control-label">Item Name *</label>
					<div class="col-sm-10">
						<input required type="text" class="form-control" id="item_name" name="item_name" maxlength="50" placeholder="">
					</div>
				</div>';

			// Fetches categories from the database
	echo '		<div class="form-group">
					<label for="item_category" name="item_category" class="col-sm-2 control-label">Category *</label>
					<div class="col-sm-10">
						<select required name="item_category" class="form-control">
						<option disabled selected>&mdash; Choose a category &mdash;</option>';

						// Loop through all the categories and output it in the dropdown
						$categories = CategoryHandler::getAllCategories();
						//echo "<li><a data-id='all' href='#'>All categories</a></li>\n";
						foreach($categories as $cat){
							// Make sure to encode special characters to HTML entities
							$cat['title'] = htmlspecialchars($cat['title']);
							echo "<option value='{$cat['id']}'>{$cat['title']}</option>";
						}

	echo '				</select>
					</div>
				</div>';


	echo '		<!--Item Price-->
				<div class="form-group">
					<label for="item_price" class="col-sm-2 control-label">Price *</label>
					<div class="col-sm-10">
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input required type="number" class="form-control" id="item_price" name="item_price" min="0" max="99999.99" step="0.01" maxlength="8" placeholder="Amount in dollars and cents">
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="item_keywords" class="col-sm-2 control-label">Keywords *</label>
					<div class="col-sm-10">
						<input required type="text" class="form-control" id="item_keywords" name="item_keywords" maxlength="255" placeholder="lenovo, laptop, quad-core, i7, blu ray">
					</div>
				</div>

				<!--Item description -->
				<div class="form-group">
					<label for="item_description" class="col-sm-2 control-label">Description *</label>
					<div class="col-sm-10">
						<textarea required type="text" rows="5" class="form-control" id="item_description" style="resize: none;" name="item_description" maxlength="5000" placeholder="Details: condition, specs, missing parts, damages, etc."></textarea>
					</div>
				</div>
				
				<!--Image upload -->
				<div class="form-group">
					<label for="item_image" class="col-sm-2 control-label">Image *</label>
					<div class="col-sm-10">
						<input required type="file" id="inputFile" name="inputFile" class="form-control">
					</div>
				</div>

				<p class="alert alert-info">
					<strong>Notice:</strong> Your listing will be reviewed by an admin and must be approved before it is posted.
				</p>

				<div class="form-group">
					<div class="col-sm-12">
						<button type="reset" class="btn btn-default pull-left">Clear Form</button>
						<button type="submit" class="btn btn-primary pull-right">Submit</button>
					</div>
				</div>

			</form>
		</div>

		<!-- Payment info -->
		<div class="col-12 col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="lead">Payment Information</span>
				</div>

				<div class="panel-body">';
					include('cc.html');
	echo '		</div>
			</div>
		</div>

	</div>';
}
?>

<?php
include('footer.php')
?>
