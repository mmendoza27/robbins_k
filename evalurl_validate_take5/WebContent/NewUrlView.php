<?php 

class NewUrlView {
	private $model;
	public function __construct($model) {
		$this->model = $model;
	}
	public function render() {
		$url = $this->model->validateName ( $_POST ['url_name'] );
		echo "IN render: $url<br>";
		return "<html>
			<head>
			<meta charset='ISO-8859-1'>
			<title>New url $url </title>
			</head>
			<body>
			<h1>New URL-NASH entry</h1>
			
			<section>
			<h3> You have successfully entered the URL:$url</h3>
			<p><a href = 'index.php'>Return to main page</a></p>
			</section>
			</body>
			</html>";
	}
}
?>
