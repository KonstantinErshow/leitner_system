<?php

class CabinetController extends Controller {

	private $pageTpl = "/views/cabinet.tpl.php";

	public function __construct() {
		$this->model = new CabinetModel();
		$this->view = new View();
	}

	public function index() {

		if (!$_SESSION['user'])
		{
			header("Location: /leitner_system/");
			die();
		}
		$this->pageData['title']="Кабинет";

		$cardsLearn = $this->model->getLearnCardsCount();
		$this->pageData['cardsLearn']= $cardsLearn;


		$newCardsCount = $this->model->getNewCardsCount();
		$this->pageData['newCards']= $newCardsCount;

		$forTodayCount = $this->model->getCardsForTodayCount();
		$this->pageData['cardsForTodayCount']= $forTodayCount;

		$cardsLearned = $this->model->getLearnedCardsCount();
		$this->pageData['cardsLearned']= $cardsLearned;


		$userCollectionsCount = $this->model->getCollectionsCount();
		$this->pageData['collectionsCount']= $userCollectionsCount;

		

		$this->view->render($this->pageTpl, $this->pageData);
	}

	public function logout() {
		session_destroy();
		header("Location: /leitner_system/");
	}

}