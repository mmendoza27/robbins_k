<?php 
 class UrlController {
    private $model;
    
    public function __construct(array $options = array()) {
        if (empty($options) || !is_array_key('db')) {
           $this->model = null;
        }
        else {
        	$this->model = new UrlModel($options('db'));
        }
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