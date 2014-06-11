<?php
include('header.php');
include('searchbar.php');
?>

<div class='row'>
	<!--Side Bar-->
	<div class="col-md-2">
		<?php include('sidebar.php'); ?>
	</div>
	
	<!--Left Frame-->
	<div class='col-sm-10'>

		<!--Main Content-->
		<div class='row'>

			<?php
			$id = (int) @$_GET['item'];

			if(!empty($id) && is_numeric($id) && $id >= 1) {
				$item = ItemHandler::getUnpublishedItemWithId($id);
			} else {
				$item = null;
			}
			?>
			
			<?php
			if($item != null) { // Checks for valid item id
				// Need to change to return to results.php when search is used
				echo "<h4><a href='category.php?id={$item->getCategory()}'>&laquo; Back to Category Listings</a></h4>";
				$seller = UserHandler::getUserWithId((int) $item->getSellerId());
				// Change newline characters to <br> for displaying in html
				$formattedDescription = nl2br($item->getDescription());

				echo "
				<div class='panel panel-default'>
					<div class='panel-heading'>
						<h2>{$item->getTitle()}</h2>
					</div>

					<div class='panel-body'>
						<div class='row'>
							<div class='col-md-3'>
								<a href='{$item->getImgPath()}' target='_blank'>
								<h3 class='text-center'><img width='200' src='{$item->getImgPath()}' alt='Image'></h3>
								<p class='text-center'>Click to view full image</p></a>
							</div>

							<div class='col-md-9'>
								<h4>Seller: <strong>{$seller->getUsername()}</strong></h4>
								<h4>Date Posted: <strong>{$item->getPostedTimestamp()}</strong></h4>
								<br>
								<h4>Price: <span class='lead'><strong>{$item->getPrice()}</strong></span></h4>
				";
							// Checks if user is the seller
							if(!empty($_SESSION['logged_in']) && ($item->getSellerId() == $_SESSION['user']->getId())) {
								echo "<p class='lead'><strong>This is your Item!</strong></p>";
							} else {
								echo "<a href='send_message.php?item={$item->getId()}' class='btn btn-primary btn-lg'>Contact Seller to Buy</a>";
							}
				echo "
							</div>
						</div>

						<hr>
						<div class='row'>
							<p><span class='lead'>Keywords: </span>{$item->getKeywords()}</p>
						</div>

						<hr>
						<div class='row'>
							<p><span class='lead'>Item Description:</span><br>
							{$formattedDescription}</p>
						</div>
					</div>
				</div>
				";
			} else { // If an invalid item id is entered
				echo "
				<h4><a href='index.php'>&laquo; Back to Home</a></h4>

				<div class='panel panel-default'>
					<div class='panel-heading'>
						<p class='lead text-center'>Listing not found. Please go back and try again.</p>
					</div>
				</div>
				";
			}
			?>

		</div>
	</div>
</div>

<?php
include('footer.php');
?>
