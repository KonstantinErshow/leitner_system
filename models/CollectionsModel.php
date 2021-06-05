<?php

class CollectionsModel extends Model {

public function getAllCollections() {
		$result = array();
		$sql = "SELECT collections.id as col_id, name, (SELECT COUNT(*) FROM flashcards where collections_id=col_id) as count, (SELECT COUNT(*) FROM flashcards where collections_id=col_id and buckets_id<4) as new_cards FROM collections WHERE users_id = :id";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $_SESSION['userId'], PDO::PARAM_INT);
		$stmt->execute();

		while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['col_id']]=$row;
		}

		return $result;
	}

public function addFromCSV($data, $collectionId) {
	
		$sql="INSERT INTO flashcards(front_side,back_side, collections_id, buckets_id) VALUES(:front_side, :back_side,:collectionId,1)";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":front_side", $data[0], PDO::PARAM_STR);

		$stmt->bindValue(":back_side", $data[1], PDO::PARAM_STR);
		$stmt->bindValue(":collectionId", $collectionId, PDO::PARAM_INT);
		$stmt->execute();

	}


public function getCollectionById($id) {
	$result = array();
	$sql = "SELECT * from collections where id=:id and users_id=:us_id";
	$stmt = $this->db->prepare($sql);
	$stmt->bindValue(":us_id", $_SESSION['userId'], PDO::PARAM_INT);
	$stmt->bindValue(":id", $id, PDO::PARAM_INT);
	$stmt->execute();
	$result=$stmt->fetch(PDO::FETCH_ASSOC);
	
	if (!empty($result)) {
		return $result;}
	else {
		return false;
	}
	
}

public function saveCollectionName($id, $name) {

	$sql = "UPDATE collections
				SET name = :name
				WHERE id=:id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->bindValue(":name", $name, PDO::PARAM_STR);
		$stmt->execute();
		return true;
}

public function createCollection($userId, $name) {

	$sql = "INSERT INTO collections (users_id, name) values (:userId,:name);";
	$stmt = $this->db->prepare($sql);
	$stmt->bindValue(":userId", $userId, PDO::PARAM_INT);
	$stmt->bindValue(":name", $name, PDO::PARAM_STR);
	$result = $stmt->execute(); 
	return $result;
	
}

public function deleteCollection($id) {

	$sql = "DELETE FROM collections WHERE id=:id ";
	$stmt = $this->db->prepare($sql);
	$stmt->bindValue(":id", $id, PDO::PARAM_INT);
 
	$result = $stmt->execute();
	return $result;
	
}

	
}