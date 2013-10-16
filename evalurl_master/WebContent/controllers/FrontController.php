<?php
//require_once (realpath($_SERVER["DOCUMENT_ROOT"] . "/evalurl_master/autoload.php"));
require_once (dirname(__FILE__). '/../autoload.php');
class FrontController {
    const DEFAULT_CONTROLLER = "IndexController";
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
        echo "path in initializeUri: $path <br>";
        if (strpos($path, $this->basePath) === 0) { // starts with basePath
            $path = substr($path, strlen($this->basePath));
        }
        if (strpos($path, '/') === 0) { //remove leading /
        	$path = substr($path, 1);
        }
    
        @list($controller, $action, $params) = explode("/", $path, 3);
        $vals = ["controller" => $controller, "action" => $action, "params" => array($params)];
        echo "In initialization 1: ";
        print_r($vals);
        $vals2 = array("abc" => "abcd");
        print_r($vals2);
        return $vals;
    }
        
    public function setOptions($options) {
    	echo "<br>In set options: ";
    	print_r($options);
		if (isset ($options ["controller"] ) && strlen ( $options["controller"]) > 0 ) {
			echo "setting a controller<br>";
			$this->setController ( $options ["controller"] );
		} else {
			$this->request->setController ( self::DEFAULT_CONTROLLER );
			echo "setting default controller ";
		}
		echo $this->request->getController () . " <br>";
		if (isset ( $options ["action"] ) && strlen ( $options ["action"]) > 0) {
			$this->setAction ( $options ["action"] );
		} else {
			$this->request->setAction ( self::DEFAULT_ACTION );
		}
		if (isset ($options ["params"])) {
			$this->setParams ( $options ["params"] );
		}
		echo "Set options<br>";
		print_r ( $options );
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
    	$args = array("request" => $this->request, "response" => $this->response);
    	//$funs = array($this->request->getController(), $this->request->getAction());
    	$funs = array('UrlController', 'show');
    	print_r($args);
    	print_r($funs);
        call_user_func_array($funs, $args);
    }
}
?>