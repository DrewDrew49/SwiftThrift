<?php
include('header.php');
include('searchbar.php');
?>

<div class="row">
	<!--Side Bar-->
	<div class="col-md-2">
		<?php include('sidebar.php'); ?>
	</div>

	<!--Left Frame-->
	<div class="col-md-10">

		<!--Main Content-->
		<div class="row">

			<?php

			$id = (int) @$_GET['id'];

			if(empty($id)){
				$id = 999;
			}

			if(!empty($id) && is_numeric($id) && $id != 0){
				$category = CategoryHandler::getCategoryWithId($id);
			} else {
				$category = null;
			}

			$allItems = ItemHandler::getItemsForCategoryId($category['id']);

			$count = 0;
			foreach($allItems as $i){
				if($i != null && $i->getPublished()){
					$count++;
				}
			}
			?>

			<div class="row">
				<h4 class="pull-left"><a href="index.php">&laquo; Back to Home</a></h4>
				<!-- If pagination is added, the listing counter will have to change -->
				<h4 class="pull-right">Displaying <?php echo $count; ?> listing(s)</h4>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>
					<?php
					if($category != null){
						echo $category['title'];
					} else {
						echo "No category";
					}
					?>
					</h2>
				</div>

				<div class="table-responsive">
					<?php

					if(empty($allItems)){
						echo '<p class="lead text-center">No listings in this category yet.</p>';
					} else {
						echo '<table class="table">

						<tr>
							<th>Image</th>
							<th>Item Name</th>
							<th>Description</th>
							<th>Seller</th>
							<th>Date Posted</th>
							<th>Price</th>
						</tr>';

						foreach($allItems as $item){
							if($item != null){
								$seller = UserHandler::getUserWithId((int) $item->getSellerId());
								// shorten description if over 200 characters
								$shortDescription = substr($item->getDescription(), 0, 200);
								if(strlen($item->getDescription()) > 200){
									$shortDescription .= "..." . "<a href='detailed.php?item={$item->getId()}'> Read More</a>";
								}

								echo "
								<tr>
									<td><a href='detailed.php?item={$item->getId()}'><img width='140' src='{$item->getImgPath()}' alt='Image' class='img-thumbnail'></a></td>
									<td><a href='detailed.php?item={$item->getId()}'>{$item->getTitle()}</a></td>
									<td>$shortDescription</td>
									<td>{$seller->getUsername()}</td>
									<td>{$item->getPostedTimestamp()}</td>";
								// Checks if user is the seller
								if(!empty($_SESSION['logged_in']) && ($item->getSellerId() == $_SESSION['user']->getId())) {
									echo "<td class='col-md-2 text-center'><p><strong>This is your Item!</strong></p> for {$item->getPrice()}</td>";
								} else {
									echo "<td class='col-md-2 text-center'><a href='send_message.php?item={$item->getId()}' class='btn btn-primary btn-block'>Buy</a> for {$item->getPrice()}</td>";
								}
								echo "
								</tr>";
							}
						}

						echo '</table>';
					}

					?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include('footer.php');
?>
