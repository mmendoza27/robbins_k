<?php 

class TestController {
	private $model;
	
	public function __construct(array $options = array()) {
         $this->model = null;
	}

	 public function show($var) {
	 	echo "<html><body>";
	 	echo "<h3>Showing in TestController:</h3>";
	 	echo "<h3>Giving options:</h3>";
	 	echo "<ul>";
	 	echo "<li>Testing</li>";
	 	echo "<li>Link to test URL controller show: <a href=\"/url/show\">URL-show</a></li>" +
	 	     "<li>Link to test URL controller show: <a href=\"/url/show/0\">URL-show-0</a></li>";
	 	echo "</ul>";
	 	//print_r($var);
	 }
}
?>