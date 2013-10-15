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
     
    public function __construct(array $options = array()) {
        if (empty($options)) {
           $this->initialize();
        }
        else {
            if (isset($options["controller"])) {
                $this->setController($options["controller"]);
            }
            if (isset($options["action"])) {
                $this->setAction($options["action"]);    
            }
            if (isset($options["params"])) {
                $this->setParams($options["params"]);
            }
        }
        $this->params['db'] = $this->buildDb("localhost", "krobbins", "abc123", "evalurls");
    }
     
    protected function initialize() {
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
        echo "Parsing URI: $path<br>";
        $path = preg_replace('/[^a-zA-Z0-9\/_]/', "", $path);
        if (strpos($path, $this->basePath) === 0) { // starts with basePath
            $path = substr($path, strlen($this->basePath));
        }
        if (strpos($path, '/') === 0) { //remove leading /
        	$path = substr($path, 1);
        }
        echo "Path is: $path<br>";
        @list($controller, $action, $params) = explode("/", $path, 3);
        echo "controller = $controller <br>";
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
     
    public function setController($controller) {
    	echo "<br>In setController: $controller<br>";
        $controller = ucfirst(strtolower($controller)) . "Controller";
        if (!class_exists($controller)) {
            throw new InvalidArgumentException(
                "The action controller '$controller' has not been defined.");
        }
        $this->controller = $controller;
        return $this;
    }
     
    public function setAction($action) {
        $reflector = new ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)) {
            throw new InvalidArgumentException(
                "The controller action '$action' has been not defined.");
        }
        $this->action = $action;
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