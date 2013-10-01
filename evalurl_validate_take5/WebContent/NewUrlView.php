<?php 

class NewUrlView {
	private $model;
	public function _construct($model) {
		echo "In view constructor";
		$this->model = $model;
	}
	public function render() {
		$url = $this->model->validateName ( $_POST ['url_name'] );
		return "<html>
			<head>
			<meta charset='ISO-8859-1'>
			<title>New url $url </title>
			</head>
			<body>
			<h1>New URL-NASH entry</h1>
			
			<section>
			<h3> You have successfully entered the URL:</h3>" . print_r ( $_POST ) . 
			
					"<p><a href = 'index.php'>Return to main page</a></p>
			</section>
			</body>
			</html>";
	}
}
?>
