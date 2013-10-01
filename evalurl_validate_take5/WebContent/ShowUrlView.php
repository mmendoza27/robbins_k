<?php 

class NewUrlView {
	private $model;
	public function __construct($model) {
		$this->model = $model;
	}
	public function render() {
		$url = $this->model->validateName ( $_POST ['url_name'] );
		echo "IN render: $url<br>";
		$head = "<html>
			<head>
			<meta charset='ISO-8859-1'>
			<title>URL-NASH entries</title>
			</head>
			<body>
			<h1>URL-NASH entries so far</h1>
			
			<section>";
		$body = "";
			while ($row = $model->nextUrl()) {
			  $body = $body."URL: " . $row["url_name"] . "<br>";
		    }
		$foot = "<p><a href = 'index.php'>Return to main page</a></p>
			    </section>
			    </body>
			    </html>";
		
        return $head.$body.$foot;    
	}
}
?>
