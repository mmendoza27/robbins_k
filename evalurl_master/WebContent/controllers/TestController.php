<?php 

class TestController {
	private $request;
	private $response;
	
	public function __construct($request, $response) {
         $this->request = $request;
         $this->response = $response;
	}
	
	public function index() {
		$this->response->addResponse(
		 	"<h3>Index in TestController:</h3>");
	}

	 public function show() {
	 	$this->response->addResponse("First response<br>");
	 	$this->response->addResponse("Now again");
	
	 }
}
?>