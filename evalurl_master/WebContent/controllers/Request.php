<?php
class Request {
 private $uri ='';
 private $params = array();
 private $controller = '';
 private $action = '';
 private $request = '';
 
  public function __construct() {
  }
  
  public function getAction() {
  	return $this->action;
  }
  
  public function getController() {
  	return $this->controller;
  }
  
  public function getParam($key) {
  	if (!isset($this->params[$key])) {
  		throw new \InvalidArgumentException("The request parameter with key '$key' is invalid.");
  	}
  	return $this->params[$key];
  }
  
  public function getParams() {
  	return $this->params;
  }
  
  public function getRequest() {
  	return $this->request;
  }
  
  public function getUri() {
    return $this->uri;
  }
  

  public function setAction($action) {
  	$this->action = $action;
  	return $this;
  }
  
  public function setController($controller) {
  	$this->controller = $controller;
  	return $this;
  }
  
  public function setParam($key, $value) {
  	$this->params[$key] = $value;
  	return $this;
  }
  
  public function setParams($params) {
  	$keys = array_keys($params);
  	foreach($keys as $key) {
  	   $this->params[$key] = $params[$key];
  	}
  	return $this;
  }
  
  public function setRequest($request) {
  	$this->request = $request;
  	return $this;
  }
  
  public function setUri($uri) {
  	$this->uri = $uri;
  	return $this;
  }
  

}

?>