<?php 
 class UrlController {
    private $request;
	private $response;
	private $model;
    
    public function __construct($request, $response) {
         $this->request = $request;
         $this->response = $response;
         $this->model = new UrlModel($request->getParam('db'));
    }
    
    public function create() {
    	$this->response->addResponse("Url controller: Create method being executed");
    }
    
    public function index() {
   	$this->response->addResponse("Url controller: Index method being executed");
    }
    
    public function showall() {
    	$this->response->addResponse("Url controller: Showall method being executed");
    }
    
    public function show() {
      	$this->response->addResponse("Url controller: Show method being executed");
    }
 }
?>