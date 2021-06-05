<?php 
class CollectionsController extends Controller {

	private $pageTpl = "/views/collections.tpl.php";

	public function __construct() {
		$this->model = new CollectionsModel();
		$this->view = new View();
	}

	public function index() {
		if (!$_SESSION['user']) {
			header("Location: /leitner_system/");
			die();	
		}

	
		$this->pageData['title'] = "Коллекции";
		$this->pageData['collections'] = $this->model->getAllCollections();
		

		$this->view->render($this->pageTpl, $this->pageData);



		if($_FILES) {
			if($_FILES['csv']['type']!='application/vnd.ms-excel' || $_FILES['csv']['type']=='') {
				$this->pageData['errors']="Ошибка загрузки файла. Проверьте формат файла.";
			}
			else if(move_uploaded_file($_FILES['csv']['tmp_name'], UPLOAD_DIR. $_FILES['csv']['name'])) {
				$file=fopen(UPLOAD_DIR. $_FILES['csv']['name'],"r");
				$rowCount=1;
				while($data = fgetcsv($file, 16777215, ";")) {
					if ($rowCount==1) {
						$rowCount++;
						continue;
					} else {
						
						$this->model->addFromCSV($data, $_POST["colId"] );
						
					}
			}
			fclose($file);
			
			}
		}

	}

		
 
	
	public function getCollectionById() {
		if(!$_SESSION['user']) {
			header("Location: /leitner_system/");
			die();
		}

		if(isset($_POST['id'])) {
			$collectionId = $_POST['id'];
			if($collectionInfo = $this->model->getCollectionById($collectionId)) {
				echo json_encode($collectionInfo);
				
			} else {
				echo json_encode(array("success" => false, "text" => "Не существует"));
			}
		} else {
			echo json_encode(array("success" => false, "text" => "Ошибка"));
		}
	}

	public function saveCollection() {
		if(!$_SESSION['user']) {
			header("Location: /leitner_system/");
			die();
		}

		if (!empty($_POST['id']) && !empty($_POST['name'])) {
			$collectionId=$_POST['id'];
			$collectionName=$_POST['name'];
			$this->model->saveCollectionName($collectionId,$collectionName);
			echo json_encode(array("success" => true, "text" => "Название коллекции обновлено"));
		}
		else {
			echo json_encode(array("success" => false, "text"=>"Проверьте введенные данные"));

		}

	
}

	public function createCollection() {

		if (!$_SESSION['user']) {
			header ("Location:/leitner_system/");
			die();
		}

		if (!empty($_POST['userId'] && !empty($_POST['name']))) {
			$userId = $_POST['userId'];
			$collectionName = $_POST['name'];
			$result = $this->model->createCollection($userId, $collectionName);
			if ($result) {
				echo json_encode(array("success"=>true, "text" =>"Коллекция создана"));
			}
			else {
				echo json_encode(array("success"=>false, "text" =>"Коллекция с таким именем уже существует"));
			}

		}
		else {
			echo json_encode(array("success"=>false, "text" =>"Проверьте введенные данные"));
		}
	}

	public function deleteCollection() {
		if (!$_SESSION['user']) {
			header ("Location:/leitner_system/");
			die();
		}

		if (!empty($_POST['id'])) {
			$id = $_POST['id'];
			$result = $this->model->deleteCollection($id);
			if ($result) {
				echo json_encode(array("success"=>true, "text" =>"Успешно удалено"));
			}
			else {
				echo json_encode(array("success"=>false, "text" =>"Ошибка"));
			}

		}
		 
	}


}
