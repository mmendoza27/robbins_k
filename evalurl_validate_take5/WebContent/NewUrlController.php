<?php
require_once('UrlModel.php');
require_once('NewUrlView.php');

class NewUrlController {
	private $model;
	private $view;

	public function __construct($db) {
		$this->model = new UrlModel($db);
		$this->view = new NewUrlView($this->model);
	}
	
	public function action() {
		try {
		  $this->model->create($_POST);
		  echo $this->view->render();
		} catch (Exception $e) {
		   echo "Bad model";
		}
	}

}

?>