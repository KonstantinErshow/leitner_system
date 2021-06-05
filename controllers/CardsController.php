<?php

class CardsController extends Controller {

	private $pageTpl = "/views/cards.tpl.php";

	public function __construct() {
		$this->model = new CardsModel();
		$this->view = new View();
	}

	public function index() {
		if (!$_SESSION['user']) {
			header("Location: /leitner_system/");
		}

		
		$this->pageData['cards'] = $this->model->getAllCards();
		$this->pageData['title'] = "Карточки";
		$this->pageData['collections'] = $this->model->getCollectionNames();
		$this->view->render($this->pageTpl, $this->pageData);


		
	}

	public function getCardsFromCollection() {
		if (!$_SESSION['user']) {
			header("Location: /leitner_system/");
		}

		if (!isset($_POST['col_id'])) {
			echo json_encode(array("success" => false));
		}
		else {
			$this->pageData['cards'] = $this->model->getAllCardsFromCollection($_POST['col_id']);
			$this->pageData['title'] = "Карточки";
			$this->pageData['collections'] = $this->model->getCollectionNames();
			$this->view->render($this->pageTpl, $this->pageData);
		}

	}


	


	public function getCard() {
		if (!$_SESSION['user']) {   //если есть сессия - пользователь авторизован
			header("Location: /leitner_system/");
			die(); //было return
	}

	if (!isset($_GET['id'])) {
		echo json_encode(array("success"=>false));
	}
	else {
		$cardId=$_GET['id'];
		$cardInfo = json_encode($this->model->getCardById($cardId));
		echo $cardInfo;
	}

}

	public function saveCard() {
		if (!$_SESSION['user']) {   //если есть сессия - пользователь авторизован
			header("Location: /leitner_system/");
			die();
	}

		if (!isset($_POST['id']) || trim($_POST['front_side'])=='' || trim($_POST['back_side'])=='') {
			echo json_encode(array("success" => false));
		}
		else {
			$cardId=$_POST['id'];
			$cardFrontSide=$_POST['front_side'];
			$cardBackSide = $_POST['back_side'];
		}

		if ($this->model->saveCardInfo($cardId,$cardFrontSide, $cardBackSide)) {
			echo json_encode(array("success" => true));
		} else {
			echo json_encode(array("success" => false));
		}
	}

	public function deleteCard() {
		if (!$_SESSION['user']) {   //если есть сессия - пользователь авторизован
			header("Location: /leitner_system/");
			return;
	}

		if (empty($_POST) || !isset($_POST['id'])) {
			echo json_encode(array("success" => false));
		}
		else {
			$cardId=$_POST['id'];
			
		}

		if ($this->model->deleteCard($cardId)) {
			echo json_encode(array("success" => true));
		} else {
			echo json_encode(array("success" => false));
		}
	}


}