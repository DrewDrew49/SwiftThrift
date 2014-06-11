<h3>Browse Categories</h3>
<ul id="sidebar" class="nav nav-stacked">
	<?php
	// Loop through all the categories and output it in the dropdown
	$categories = CategoryHandler::getAllCategories();
	foreach($categories as $cat){
		// Make sure to encode special characters to HTML entities
		$cat['title'] = htmlspecialchars($cat['title']);
		echo "<li><a href='category.php?id={$cat['id']}'>{$cat['title']}</a></li>\n";
	}
	?>
</ul>
