<?php
// Calls ItemHandler class to handle item publication status using the POST data from button
include_once('backend/includes.php');
session_start();

if (isset($_POST['publish_id'])) {
	$data = intval($_POST['publish_id']);
	$status = ItemHandler::publishItemWithId($data);

	// If successfully published
	if($status){
		Utils::emailListingApproved((int)$_POST['publish_id']);
	}

	return $status;
} elseif (isset($_POST['deny_id'])) {
	$data = intval($_POST['deny_id']);
	return ItemHandler::unpublishItemWithId($data);
} elseif (isset($_POST['delete_id'])) {
	$data = intval($_POST['delete_id']);
	// backup data for email before delete
	$item = ItemHandler::getItemWithId($data);
	$itemName = $item->getTitle();
	$sellerId = $item->getSellerId();
	// delete item
	$status = ItemHandler::deleteItemWithId($data);

	//if successfully deleted, need to do something to prevent user getting email when they delete their own item.
	if($status && ($_SESSION['user']->getId() != $sellerId)){
		Utils::emailListingDenied($itemName, $sellerId);
	}elseif($status){
		// The user deleted their own listing
		Utils::emailListingDeleted($itemName, $sellerId);
	}

	return $status;
} elseif (isset($_POST['user_id'])) {
	$data = intval($_POST['user_id']);
	// delete user's items before deleting user
	$itemArray = ItemHandler::getItemsForSellerId($data);
	foreach($itemArray as $item) {
		ItemHandler::deleteItemWithId((int)$item['id']);
	}
	// delete user
	return UserHandler::deleteUserWithId($data);
} elseif (isset($_POST['admin_id'])) {
	$data = intval($_POST['admin_id']);
	return UserHandler::makeAdmin($data);
} else {

	return 1;
}

?>
