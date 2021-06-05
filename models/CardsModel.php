<?php

class CardsModel extends Model {

	public function getAllCards() {
		$result = array();
		$sql = "SELECT flashcards.id, front_side, back_side, name FROM flashcards LEFT JOIN collections ON flashcards.collections_id = collections.id INNER JOIN users ON users.id=collections.users_id WHERE login=:login";

		$stmt = $this->db->prepare($sql);
		#print_r($_SESSION);
		$stmt->bindValue(":login", $_SESSION['user'], PDO::PARAM_STR);
		$stmt->execute();

		while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']]=$row;
		}

		return $result;
	}

	public function getAllCardsFromCollection($collectionId) {
		$result = array();
		$sql = "SELECT flashcards.id, front_side, back_side, name FROM flashcards LEFT JOIN collections ON flashcards.collections_id = collections.id INNER JOIN users ON users.id=collections.users_id WHERE login=:login and collections_id=:collectionId";

		$stmt = $this->db->prepare($sql);
		#print_r($_SESSION);
		$stmt->bindValue(":login", $_SESSION['user'], PDO::PARAM_STR);
		$stmt->bindValue(":collectionId",$collectionId, PDO::PARAM_INT);
		$stmt->execute();

		while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']]=$row;
		}

		return $result;
	}

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

	
	public function getCardById($id) {
		$result=array();
		$sql="SELECT * FROM flashcards WHERE id=:id";
		$stmt= $this->db->prepare($sql);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$result=$stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function saveCardInfo($id, $front_side, $back_side)
	{
		$sql = "UPDATE flashcards
				SET front_side = :front_side, back_side = :back_side
				WHERE id=:id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->bindValue(":front_side", $front_side, PDO::PARAM_STR);  //не будет ли урезания STR? в БД MEDIUMTEXT
		$stmt->bindValue(":back_side", $back_side, PDO::PARAM_STR);
		$stmt->execute();
		return true;

	}

	public function deleteCard($id)
	{
		$sql = "DELETE FROM flashcards WHERE id=:id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$count = $stmt->rowCount(); //сколько строк было затронуто в результате запроса
		if ($count>0) {
			return true;
		}
		else {
			return false;
		}

	}

}