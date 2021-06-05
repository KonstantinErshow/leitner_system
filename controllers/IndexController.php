<?php

//работа главной страницы (отслеживание)

class IndexController extends Controller {

	private $pageTpl = '/views/main.tpl.php'; //шаблон страницы


	public function __construct() {
		$this->model = new IndexModel();
		$this->view = new View();
	}


	public function index() {
		$this->pageData['title'] = "Вход в личный кабинет";
		

		if(!empty($_POST)) {
			 
			$action = $_POST['action'];
			switch ($action) {
				case 'login':
					if (!$this->login()) {
						$this->pageData['errorLog'] = "Неправильный логин или пароль";
					}
					break;
				
				case 'register':
					if ($this->register()) {
						$this->pageData['regMessages'] = "Регистрация прошла успешно. Войдите в систему";
					}
					else {
						$this->pageData['regMessages'] = "Ошибка регистрации";
					}
					break;
			}

 
		}

		$this->view->render($this->pageTpl, $this->pageData); //отрисовка
	}

	//авторизация в отдельном методе
	public function login() {
		if(!$this->model->checkUser())  {
			return false;

		}

	}

	public function register() {

		if (!empty($_POST['fullName']) && !empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])   )
		{

			$userName = $_POST['fullName'];
			$login = $_POST['login'];
			$email = $_POST['email'];
			$password =  $_POST['password'];
			
			$password2 = password_hash($password,PASSWORD_DEFAULT);
		
			$this->model->createNewUser($userName, $login, $email, password_hash($password, PASSWORD_DEFAULT));
			return true;
		}

		else 
		{
			$this->pageData['regMessages']="Заполните все поля формы";
			return false;
		}
	}
}