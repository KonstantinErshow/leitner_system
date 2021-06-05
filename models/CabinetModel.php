<?php

class CabinetModel extends Model {

	public function getLearnCardsCount() {
		$id = $_SESSION['userId'];
		$sql="SELECT COUNT(*) from flashcards INNER JOIN collections ON collections_id=collections.id WHERE users_id=:id and buckets_id>1 and buckets_id<4";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $_SESSION['userId'], PDO::PARAM_INT);
		$stmt->execute();
		$res = $stmt->fetchColumn();
		return $res;
	}

	public function getCardsForTodayCount() {
		$id = $_SESSION['userId'];
		$sql="SELECT COUNT(*) from flashcards INNER JOIN collections ON collections_id=collections.id WHERE users_id=:id and next_time<=Now()";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $_SESSION['userId'], PDO::PARAM_INT);
		$stmt->execute();
		$res = $stmt->fetchColumn();
		return $res;
	}

	public function getNewCardsCount() {
		
		$sql="SELECT COUNT(*) from flashcards INNER JOIN collections ON collections_id=collections.id WHERE users_id=:id and buckets_id=1";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $_SESSION['userId'], PDO::PARAM_INT);
		$stmt->execute();
		$res = $stmt->fetchColumn();
		return $res;
	}

	public function getLearnedCardsCount() {
		
		$sql="SELECT COUNT(*) from flashcards INNER JOIN collections ON collections_id=collections.id WHERE users_id=:id and buckets_id=4";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $_SESSION['userId'], PDO::PARAM_INT);
		$stmt->execute();
		$res = $stmt->fetchColumn();
		return $res;
	}

	public function getCollectionsCount() {
		
		$sql="SELECT COUNT(*) from collections WHERE users_id=:id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $_SESSION['userId'], PDO::PARAM_INT);
		$stmt->execute();
		$res = $stmt->fetchColumn();
		return $res;
	}
}