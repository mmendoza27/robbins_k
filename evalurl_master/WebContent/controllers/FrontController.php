<?php
//require_once (realpath($_SERVER["DOCUMENT_ROOT"] . "/evalurl_master/autoload.php"));
require_once (dirname(__FILE__). '/../autoload.php');
class FrontController {
    const DEFAULT_CONTROLLER = "Index";
    const DEFAULT_ACTION     = "index";
     
    protected $basePath      = "evalurl_master";
    protected $request;
    protected $response;
     
    public function __construct($options = null) {
    	$this->request = new Request();
    	$this->response = new Response();
        if (!isset($options) || $options == null) {
           $vals = $this->initializeUri($_SERVER["REQUEST_URI"]);
           $this->setOptions($vals);
        } else {
           $this->setOptions($options);
        }
        $this->request->setParam('db', $this->buildDb("localhost", "krobbins", "abc123", "evalurls"));
    }
     
    public function initializeUri($uri) {
        $path = trim(parse_url($uri, PHP_URL_PATH), "/");
        $path = preg_replace('/[^a-zA-Z0-9\/_]/', "", $path);
        if (strpos($path, $this->basePath) === 0) { // starts with basePath
            $path = substr($path, strlen($this->basePath));
        }
        if (strpos($path, '/') === 0) { //remove leading /
        	$path = substr($path, 1);
        }
    
        @list($controller, $action, $params) = explode("/", $path, 3);
        return ["controller" => $controller, "action" => $action, "params" => array($params)];
    }
        
    public function setOptions($options) {
		if (isset ($options ["controller"] ) && strlen ( $options["controller"]) > 0 ) {
			$this->setController ( $options ["controller"] );
		} else {
			$this->setController ( self::DEFAULT_CONTROLLER );
		}
		if (isset ($options ["action"]) && strlen ($options ["action"]) > 0) {
			$this->setAction ($options ["action"]);
		} else {
			$this->setAction ( self::DEFAULT_ACTION );
		}
		if (isset ($options ["params"])) {
			$this->setParams ( $options ["params"] );
		}
		return $this;     
    }
    
    public function getRequest() { // for debugging
    	return $this->request;
    }
    
    public function getResponse() { // for debugging
    	return $this->response;
    }
    
    public function setAction($action) {
    	$reflector = new ReflectionClass($this->request->getController());
    	if (!$reflector->hasMethod($action)) {
    		throw new InvalidArgumentException(
    				"The controller action '$action' has been not defined.");
    	}
    	$this->request->setAction($action);
    	return $this;
    } 
     
    public function setController($controller) {
        $controller = ucfirst(strtolower($controller)) . "Controller";
        if (!class_exists($controller)) {
            throw new InvalidArgumentException(
                "The action controller '$controller' has not been defined.");
        }
        $this->request->setController($controller);
        return $this;
    }
     
    public function setParams(array $params) {
        $this->request->setParams($params);
        return $this;
    }
    
    function buildDb($hostname, $username, $userpass, $dbname) {
    	try {
    		$hostStr = "mysql:host=$hostname;dbname=$dbname;charset=utf8";
    		$db = new PDO ( $hostStr, $username, $userpass );
    		$db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    		$db->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
    		return $db;
    	} catch(PDOException $pe) {
    		echo "Bad connection: ".$pe->getMessage(); // replace with logger later
    		return null;
    	}
    }
     
    public function run() {
    	$reflect = new ReflectionClass($this->request->getController());
    	$obj = $reflect->newInstanceArgs([$this->request, $this->response]);
    	$method = new ReflectionMethod($this->request->getController(),  
    			$this->request->getAction());
    	$method->invoke($obj);
    	$this->response->send();
    }
}
?>