<?php

class Controller {
	//совершать общие действия , это родительский класс

	public $model;
	public $view;
	protected $pageData = array(); //служебный массив

	public function __construct() { //конструктор по умолчанию

		$this->view = new View(); //создается новый view и модель
		$this->model = new Model();
		
	}
}