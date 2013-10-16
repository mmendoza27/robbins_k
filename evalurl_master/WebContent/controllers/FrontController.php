<?php
//require_once (realpath($_SERVER["DOCUMENT_ROOT"] . "/evalurl_master/autoload.php"));
require_once (dirname(__FILE__). '/../autoload.php');
class FrontController {
    const DEFAULT_CONTROLLER = "IndexController";
    const DEFAULT_ACTION     = "index";
     
    protected $controller    = self::DEFAULT_CONTROLLER;
    protected $action        = self::DEFAULT_ACTION;
    protected $params        = array();
    protected $db            = null;
    protected $basePath      = "evalurl_master";
    protected $request;
    protected $response;
     
    public function __construct(array $options = array()) {
    	$this->request = new Request();
    	$this->response = new Response();
        if (empty($options)) {
           $this->initializeUri($_SERVER["REQUEST_URI"]);
        }
        else {
            if (isset($options["controller"])) {
                $this->setAction($options["controller"]);
            }
            if (isset($options["action"])) {
                $this->setAction($options["action"]);    
            }
            if (isset($options["params"])) {
                $this->setParams($options["params"]);
            }
        }
        $this->params['db'] = $this->buildDb("localhost", "krobbins", "abc123", "evalurls");
        $this->request = new Request();
        $this->response = new Response();
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
        if (isset($controller) && strlen($controller) > 0) {
            $this->setController($controller);
        }
        if (isset($action) && strlen($action) > 0) {
            $this->setAction($action);
        }
        if (isset($params) && strlen($params) > 0) {
            $this->setParams(explode("/", $params));
        } 
      
    }
    
    public function getValues() { // for debugging
    	return array("controller" => $this->controller,
    	             "action" => $this->action,
    	             "params" => $this->params);
    }
     
    public function setController($controller) {
        $controller = ucfirst(strtolower($controller)) . "Controller";
        if (!class_exists($controller)) {
            throw new InvalidArgumentException(
                "The action controller '$controller' has not been defined.");
        }
        $this->request->setParam('controller', $controller);
        return $this;
    }
     
    public function setAction($action) {
        $reflector = new ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)) {
            throw new InvalidArgumentException(
                "The controller action '$action' has been not defined.");
        }
        $this->request->setParam('action', $action);
        return $this;
    }
     
    public function setParams(array $params) {
        $this->params = $params;
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
        call_user_func_array(array(new $this->controller, $this->action), $this->params);
    }
}
?>