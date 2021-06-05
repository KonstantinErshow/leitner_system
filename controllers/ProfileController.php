<?php

class ProfileController extends Controller {

	private $pageTpl = "/views/profile.tpl.php";

	public function __construct() {
		$this->model = new ProfileModel();
		$this->view = new View();

	}

	public function index() {   
		if (!$_SESSION['user']) {
			header("Location: /leitner_system/");
		}

		$userId=$_SESSION['userId'];
		$userInfo=$this->model->getAccountInfo($userId);

		 
		$this->pageData['userInfo']=$userInfo;

		$this->pageData['title']="Профиль";
		$this->view->render($this->pageTpl,$this->pageData);
	}

	public function updateProfile() {
		if (!$_SESSION['user']) {
			header("Location: /leitner_system/");
		}

		if (empty($_POST) || !isset($_POST['login']) || !isset($_POST['email'])) {
			echo json_encode(array("success"=> false, "text"=>"Не все данные введенны!"));
		}
		else {
			$profileId=$_POST['id'];
			$profileLogin=trim($_POST['login']);
			$profileEmail = trim($_POST['email']);
			if ($this->model->updateProfile($profileId,$profileLogin, $profileEmail)) {
				echo json_encode(array("success"=> true));
			}
			else {
				echo json_encode(array("success"=> false, "text"=>"Ошибка при обновлении"));
			}
		}
	}


	public function updatePassword() {
		if (!$_SESSION['user']) {
			header("Location: /leitner_system/");
		}

		if (empty($_POST) || !isset($_POST['newpass']) || !isset($_POST['repeatpass'])) {
			echo json_encode(array("success"=> false, "text"=>"Ошибка ввода пароля"));
		}
		else {
			$profileId=$_POST['id'];
			$newPass=trim($_POST['newpass']);
			$repeatPass = trim($_POST['repeatpass']);

			if ($newPass!= $repeatPass) {
				echo json_encode (array("success"=>false, "text"=> "Несовпадение паролей"));
			} else {


			if ($this->model->updatePassword($profileId, password_hash($newPass, PASSWORD_DEFAULT))) {
				echo json_encode(array("success"=> true));
			}
			else {
				echo json_encode(array("success"=> false, "text"=>"Ошибка"));
			}


			}



		}
	}

}