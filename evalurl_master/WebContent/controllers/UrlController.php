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
    	echo "Url create me this";
    }
    
    public function index() {
    	echo "Url index me this";
    }
    
    public function showall() {
    	echo "Url showall me this";
    }
    
    public function show() {
    	echo "Url show me this";
    }
 }
?>