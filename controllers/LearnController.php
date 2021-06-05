<?php

class LearnController extends Controller {
	private $pageTpl = "/views/learn.tpl.php";


	public function __construct() {
		$this->model = new LearnModel();
		$this->view = new View();
	}

	public function index() {
		if (!$_SESSION['user']) {
			header("Location: /leitner_system/");
		}

		
		
		$this->pageData['title'] = "Обучение";	
		$this->pageData['collections']=$this->model->getCollectionNames();		
		$this->view->render($this->pageTpl, $this->pageData);	
	}

	public function getCardsFromCollection() {
		if (!$_SESSION['user']) {
			header("Location: /leitner_system/");
			die();
		}

		if (!isset($_POST['id'])) {
			echo json_encode(array("success" => false));
		}
		else {
			
			
			
			echo json_encode(array("success"=>true, "newCards"=>$this->model->getNewCards($_POST['id']), "goodCards" => $this->model->getGoodCards($_POST['id']), "easyCards" => $this->model->getEasyCards($_POST['id']) ));
		}

	}

	public function saveCards() {
		if (!$_SESSION['user']) {
			header("Location: /leitner_system/");
			die();
		}



		if (!empty($_POST['goodCards'])) 
			{
			 $this->model->saveGoodCards($_POST['goodCards']);
			}
		if (!empty($_POST['easyCards']))
			{
			 $this->model->saveEasyCards($_POST['easyCards']);
			}

		if (!empty($_POST['learnedCards']))
			{
			$this->model->saveLearnedCards($_POST['learnedCards']);
			}
		
		echo json_encode(array("success"=>true, "text"=>"Успешно"));

	}


}