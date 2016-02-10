<?php
class Loader {
		
	protected static $instance;
	protected static $namespaceMap = array();
	
	public static function getInstance(){
		if(empty(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public static function addNamespacePath($name, $path){
		if (is_dir($path)){
			self::$namespaceMap[$name] = $path;
			return true;
		}
		return false;
	}
	
	private function __construct() {
		spl_autoload_register(array(self, 'autoload'));
	}
	
	private function __clone(){
		
	}
	
	public static function autoload($class){
		$namespace = explode('\\', $class);
		
		if(is_array($namespace)){
			$name = $namespace[0].'\\';
			$path = str_replace('\\', '/', str_replace($name, '', $class));
			
			if (!empty(self::$namespaceMap[$name])) {
				$fullPath = self::$namespaceMap[$name].'/'.$path.'.php';
				
				if (file_exists($fullPath)){
					require_once($fullPath);
					return true;
				} else {
					echo 'File <b>'.$fullPath.'</b> not exists!<br>';
				}
			}
		}
		return false;
	}
}
Loader::getInstance();

Loader::addNamespacePath('Framework\\', __DIR__);