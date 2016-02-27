<?php

namespace Framework\Response;

use Framework\Response\Response;
/**
 * Description of JsonResponse
 *
 * @author steemd
 */
class JsonResponse extends Response {
    
    private $content;
            
    function __construct($array) {
        $this->content = $array;
    }
    
    private function getHeader(){
        header('HTTP/1.1 '.$this->statusCode.' '.$this->statusText[$this->statusCode]);
        header('Content-Type: application/json; charset=utf-8');
    }

    private function getContent() {
        echo json_encode($this->content, JSON_UNESCAPED_UNICODE);
    }
    
    public function send(){
        $this->getHeader();
        $this->getContent();        
    }
    
    
}
