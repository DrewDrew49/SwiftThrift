<?php
class Search {
	static function getAllAvailableKeywords(){
		// A new array to contain all our keywords
		$keywords = array();

		// Connect and run a query
		$db = new Database();
		$result = $db->query("SELECT keywords FROM items");

		// Loop through all keywords, split and trim them
		while($row = $result->fetch_assoc()){
			$splitted = explode(',', $row['keywords']);
			foreach($splitted as $kw){
				$keywords[] = trim($kw);
			}
		}

		// Return the unique keywords
		return array_unique($keywords);
	}


	static function searchForItemsWithTitleOrKeywords($searchQuery){

		$items = array();

		$db = new Database();

		$searchQuery = $db->real_escape_string($searchQuery);

		$result = $db->query("SELECT id FROM items WHERE published = 1 AND ((keywords LIKE '%$searchQuery%') OR (title LIKE '%$searchQuery%'))");

		if(!$result){
			return null;
		}

		while($row = $result->fetch_assoc()){
			$items[] = $row['id'];
		}

		return $items;

	}

	static function searchForItemsWithTitleAndKeywordsAndCategory($searchQuery, $catId){
		// The array which should be returned
		$items = array();

		$catId = (int) $catId;

		$db = new Database();
		// Escape the input
		$searchQuery = $db->real_escape_string($searchQuery);

		// Run the query
		$result = $db->query("SELECT id FROM items WHERE published = 1 AND category = $catId AND ((keywords LIKE '%$searchQuery%') OR (title LIKE '%$searchQuery%'))");

		if(!$result){
			return null;
		}

		// Fill the array
		while($row = $result->fetch_assoc()){
			$items[] = $row['id'];
		}

		// Return it
		return $items;
	}
}

?>
