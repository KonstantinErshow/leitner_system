<?php
//модель по умолчанию

class IndexModel extends Model {

	public function checkUser()
	{
		$login = $_POST['login'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM users where login=:login";

		$stmt=$this->db->prepare($sql);
		$stmt->bindValue(":login", $login, PDO::PARAM_STR);
		//$stmt->bindValue(":password", $password, PDO::PARAM_STR);
		$stmt->execute();

		$res=$stmt->fetch(PDO::FETCH_ASSOC);



		if (!empty($res['password']) && password_verify($password, $res['password'])) {
			$_SESSION['user'] = $_POST['login'];
			$_SESSION['userId'] = $res['id'];
			$_SESSION['fullName']=$res['fullName'];

			header("Location: /leitner_system/cabinet/");
		}
		else {
			return false;
		}
	}

	public function createNewUser($userName, $login, $email, $password){
		$sql = "INSERT INTO users(fullName, login, email, password) VALUES (:userName, :login, :email, :password)";
		$stmt = $this->db->prepare($sql);
		

		$stmt->bindValue(":login", $login, PDO::PARAM_STR);
		$stmt->bindValue(":userName", $userName, PDO::PARAM_STR);
		$stmt->bindValue(":email", $email, PDO::PARAM_STR);
		$stmt->bindValue(":password", $password, PDO::PARAM_STR);
		 
		$stmt->execute();


	}
}