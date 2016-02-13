<?php

/**
 * Loader is a class to load new files to framework
 * 
 * It provides methods to add new namespace and use Singleton pattern
 */
class Loader {
	/**
         * @var Loader Object
         */	
	protected static $instance;
        /**
         * @var array 
         */
	protected static $namespaceMap = array();
	/**
         * Create new object and return only one copy
         * 
         * @return Loader object
         */
	public static function getInstance(){
		if(empty(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}
	/**
         * Add new path to $namespaceMap var
         * 
         * @param string $name
         * @param string $path
         * 
         * @return boolean
         */
	public static function addNamespacePath($name, $path){
		if (is_dir($path)){
			self::$namespaceMap[$name] = $path;
			return true;
		}
		return false;
	}
	/**
         * Construct start spl_autoload_register() function
         */
	private function __construct() {
		spl_autoload_register(array(self, 'autoload'));
	}
	/**
         * Blocked to create clone of Loader class
         */
	private function __clone(){	
	}
	/**
         * Autoload new class in framework
         * 
         * @param string $class
         * 
         * @return boolean
         */
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