<?php
class UserHandler{
	static function checkIfUsernameExists($username){
		$db = new Database();
		$username = $db->real_escape_string($username);

		$result = $db->query("SELECT username FROM user");
		
		while($row = $result->fetch_assoc()){
			if($row['username'] == $username){
				return true;
			}
		}

		return false;
	}

	static function checkIfEmailExists($email){
		$db = new Database();
		$email = $db->real_escape_string($email);

		$result = $db->query("SELECT email FROM user");
		
		while($row = $result->fetch_assoc()){
			if($row['email'] == $email){
				return true;
			}
		}

		return false;
	}

	static function getUserWithId($id){
		if(!is_integer($id)){
			throw new Exception('Expected integer');
			die();
		}

		$db = new Database();
		$result = $db->query("SELECT * FROM user WHERE id = $id")->fetch_assoc();

		$user = new User(
			$result['id'],
			$result['firstname'],
			$result['username'],
			$result['email'],
			$result['password'],
			$result['admin']
		);

		$user->setHashedPassword($result['password']);

		return $user;
	}

	static function getUserWithUsername($username){
		if(!is_string($username)){
			throw new Exception('Expected integer');
			die();
		}

		$db = new Database();
		$result = $db->query("SELECT * FROM user WHERE LOWER(username) = '$username'");

		if($result->num_rows == 0){
			return false;
		} else {
			$result = $result->fetch_assoc();
		}

		$user = new User(
			$result['id'],
			$result['firstname'],
			$result['username'],
			$result['email'],
			$result['password'],
			$result['admin']
		);

		$user->setHashedPassword($result['password']);

		return $user;
	}

	static function insertUser($user){
		if(!$user instanceof User){
			throw new Exception('Incoming object is not a User');
			die();
		}

		$sql = "INSERT INTO user VALUES (NULL, '{$user->getFirstName()}', '{$user->getUsername()}', '{$user->getEmail()}', '{$user->getPassword()}', {$user->getAdmin()} )";

		$db = new Database();
		$result = $db->query($sql);
		echo $db->error;

		return $db->insert_id;
	}

	static function deleteUserWithId($id){
		if(!is_integer($id)){
			throw new Exception('Expected integer');
			die();
		}

		$db = new Database();
		$result = $db->query("DELETE FROM user WHERE id = $id LIMIT 1");

		return $result;
	}

	static function updateInfoForUserWithId($id, $user){
		if(!is_integer($id)){
			throw new Exception('Expected integer');
			die();
		}
		if(!$user instanceof User){
			throw new Exception('Incoming object is not a User');
			die();
		}

		$db = new Database();
		$result = $db->query("UPDATE user SET username = '{$user->getUsername()}', firstname = '{$user->getFirstName()}', email = '{$user->getEmail()}', password = '{$user->getPassword()}' WHERE id = $id");

		return $result;
	}

	static function getAllUsers(){

		$db = new Database();
		$result = $db->query("SELECT * FROM user ORDER BY id ASC");

		$return = array();
		
		while($row = $result->fetch_assoc()){
			$return[] = $row;
		}

		return $return;
	}

	static function makeAdmin($user){
		$db = new Database();
		$result = $db->query("UPDATE user SET admin = 1 WHERE id = $user");

		return $result;
	}

}

?>
