<?php class IndexController {
	private $request;
	private $response;

	public function __construct($request, $response) {
		$this->request = $request;
		$this->response = $response;
	}
    public function index () {
       echo "in index controller calling index<br>";
    }
}
?>