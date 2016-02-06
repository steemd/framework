<?php
namespace Framework;

class Application {
		
	private $config;
	
	function __construct($config){
		$this->config = $config;
	}
	
	public function run() {
		echo 'Configuration file: <b>'.$this->config.'</b>';
	}
	
}