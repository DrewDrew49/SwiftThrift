<?php
include('header.php');
include('searchbar.php');
?>
<div class="row">
	<!-- Categories -->
	<div class="col-md-2">
		<?php include('sidebar.php'); ?>
	</div>
	<!-- Search results -->
	<div class="col-md-10">
		<?php
		if(!empty($_POST)){

			if($_POST['categoryID'] != "all"){
				$hits = Search::searchForItemsWithTitleAndKeywordsAndCategory($_POST['query'], $_POST['categoryID']);
			} else {
				//changed this to see if it will display results based on title or keyword, instead of just title
				$hits = Search::searchForItemsWithTitleOrKeywords($_POST['query']);
			}
			$num = count($hits);

			echo "
			<div class='row'>
				<h4 class='pull-left'><a href='index.php'>&laquo; Back to Home</a></h4>
				<!-- If pagination is added, the listing counter will have to change -->
				<h4 class='pull-right'>Displaying {$num} listing(s)</h4>
			</div>";

			echo "
			<div class='panel panel-default'>
				<div class='panel-heading'>
					<h2>";
					if($_POST['categoryID'] == "all" && empty($_POST['query'])){
						echo "All Items";
					} else {
						echo "Search results for '{$_POST['query']}'";
					}
			echo "	</h2>
				</div>
				<div class='panel-body'>";

			if(empty($hits)){
				echo "<p>No listings found. Try adjusting your search terms.</p>";
			} else {
				foreach($hits as $hit){
					$item = ItemHandler::getItemWithId((int)$hit);
					$seller = UserHandler::getUserWithId((int)$item->getSellerID());
					$category = CategoryHandler::getCategoryWithId((int)$item->getCategory());

					$shortDescription = substr($item->getDescription(), 0, 200);
						if(strlen($item->getDescription()) > 200){
							$shortDescription .= "..." . "<a href='detailed.php?item={$item->getId()}'> Read More</a>";
					}

					echo "
					<div class='row'>
						<div class='col-md-2'>
							<a href='detailed.php?item={$item->getId()}'><img width='140' src='{$item->getImgPath()}'' alt='Image' class='img-thumbnail' /></a>
						</div>
						<div class='col-md-8'>
							<h4><a href='detailed.php?item={$item->getId()}'>{$item->getTitle()}</a></h4>
							<p>$shortDescription</p>
							<p>Sold by <strong>{$seller->getUsername()}</strong> in the category <strong><a href='category.php?id={$category['id']}'>{$category['title']}</a></strong></p>
						</div>
						<div class='col-md-2 text-center'>";
						// checks if user is the seller
						if(!empty($_SESSION['logged_in']) && ($item->getSellerId() == $_SESSION['user']->getId())) {
							echo "<p><strong>This is your Item!</strong></p> for {$item->getPrice()}";
						} else {
							echo "<a href='send_message.php?item={$item->getId()}' class='btn btn-primary btn-block'>Buy</a> for {$item->getPrice()}";
						}
					echo "
						</div>
					</div>
					<hr>";
				}
			}
			echo "
				</div>
			</div>";
		} else {
			echo "<h4><a href='index.php'>&laquo; Back to Home</a></h4>
			<h1>What are you looking for?</h1>
			<p>To find a listing, enter a search term into the search bar above &uarr;</p>";
		}
		?>
	</div>
</div>
<?php
include('footer.php');
?>
