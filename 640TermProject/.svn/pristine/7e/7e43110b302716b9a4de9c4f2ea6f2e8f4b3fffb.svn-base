<?php
class CategoryHandler {
	static function getCategoryWithId($id){
		if(!is_integer($id)){
			throw new Exception('Expected integer');
			die();
		}

		$db = new Database();
		$result = $db->query("SELECT * FROM category WHERE id = $id")->fetch_assoc();

		$category = array(
			"id" => (int) $result['id'],
			"title" => $result['title'],
			"description" => $result['description'],
			"parent" => (int) $result['parent']
		);

		return $category;
	}

	static function getCategoryIds(){
		$db = new Database();
		$result = $db->query("SELECT id FROM category");

		$ids = array();

		while($row = $result->fetch_assoc()){
			$ids[] = (int) $row['id'];
		}

		return $ids;
	}

	static function getAllCategories(){
		$ids = self::getCategoryIds();
		$categories = array();

		foreach($ids as $categoryID){
			$categories[] = self::getCategoryWithId($categoryID);
		}

		return $categories;
	}

	static function insertCategory($title, $description, $parentCategoryId){
		$sql = "INSERT INTO category VALUES (NULL, '$title', '$description'";
		if($parentCategoryId == 0){
			$sql .= ", NULL";
		} else {
			$sql .= ", {$parentCategoryId}";
		}
		$sql .= ")";


		$db = new Database();
		$result = $db->query($sql);

		return $db->insert_id;
	}

	static function deleteCategoryWithId($id){
		if(!is_integer($id)){
			throw new Exception('Expected integer');
			die();
		}

		$db = new Database();
		$result = $db->query("DELETE FROM category WHERE id = $id LIMIT 1");

		return $result;
	}
}
?>
