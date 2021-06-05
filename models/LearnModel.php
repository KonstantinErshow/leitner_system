<?php

class LearnModel extends Model {

	public function getCollectionNames() {
		$result = array();
		$sql = "SELECT id, name from collections WHERE collections.users_id=:user_id";

		$stmt = $this->db->prepare($sql);
		#print_r($_SESSION);
		$stmt->bindValue(":user_id", $_SESSION['userId'], PDO::PARAM_INT);
		$stmt->execute();

		while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']]=$row;
		}

		return $result;
	}

	public function getNewCards($collectionId) {
		$result = array();
		$sql = "SELECT id, front_side, back_side from flashcards where collections_id=:collectionId and (next_time <=now() or next_time is NULL) and buckets_id=1";

		$stmt = $this->db->prepare($sql);
		#print_r($_SESSION);
		$stmt->bindValue(":collectionId", $collectionId, PDO::PARAM_INT);		
		$stmt->execute();

		while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']]=$row;
		}

		return $result;
	}

	public function getGoodCards($collectionId) {
		$result = array();
		$sql = "SELECT id, front_side, back_side from flashcards where collections_id=:collectionId and next_time <=now() and buckets_id=2";

		$stmt = $this->db->prepare($sql);
		#print_r($_SESSION);
		$stmt->bindValue(":collectionId", $collectionId, PDO::PARAM_INT);		
		$stmt->execute();

		while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']]=$row;
		}

		return $result;
	}

	public function getEasyCards($collectionId) {
		$result = array();
		$sql = "SELECT id, front_side, back_side from flashcards where collections_id=:collectionId and next_time <=now() and buckets_id=3";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":collectionId", $collectionId, PDO::PARAM_INT);		
		$stmt->execute();

		while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']]=$row;
		}

		return $result;
	}	


	public function saveGoodCards($goodCardsId) {
		foreach ($goodCardsId as $id) {
			$sql="UPDATE flashcards SET next_time=DATE_ADD(Now(),INTERVAL 1 DAY), buckets_id = 2 where id=:id";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(":id", $id, PDO::PARAM_INT);		
			$stmt->execute();
		}
		unset ($id);
		return true;
	}

	public function saveEasyCards($easyCardsId) {
		foreach ($easyCardsId as $id) {
			$sql="UPDATE flashcards SET next_time=DATE_ADD(Now(),INTERVAL 2 DAY), buckets_id = 3 where id=:id";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(":id", $id, PDO::PARAM_INT);		
			$stmt->execute();
		}
		unset ($id);
			return true;
	}

	public function saveLearnedCards($learnedCardsId) {
		foreach ($learnedCardsId as $id) {
			$sql="UPDATE flashcards SET next_time=NULL, buckets_id=4 where id=:id";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(":id", $id, PDO::PARAM_INT);		
			$stmt->execute();
		}
		unset ($id);
			return true;
	}


}