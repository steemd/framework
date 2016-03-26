<?php

namespace Framework\Response;

use Framework\Response\Response;
use Framework\Session\Session;
/**
 * Its RedirectResponse Class and redirects the user to the new URL
 *
 * @author steemd
 */
class ResponseRedirect extends Response {
    
    /**
     * @var string $url
     */
    private $url;

    /**
     * ResponseRedirect Constructor method
     * 
     * @param type $url
     * @param type $text
     * @param type $status
     * @param type $contentType
     */
    function __construct($url = '/', $text = '', $status = 303, $contentType = 'text/html; charset=utf-8') {
        
        $this->status = $status;
        $this->contentType = $contentType;
        $this->content = '';
        
        if (strpos($_SERVER['REQUEST_URI'], '/web') === FALSE) {
            $this->url = $url;
        } else {
            $this->url = '/web'.$url;
        }
    }
    
    /**
     * generate response headers
     */
    public function getHeader(){
        header('HTTP/1.1 '.$this->status.' '.$this->statusText[$this->status]);
        header('Content-Type: '.$this->contentType);
        header('Location: '. $this->url);
    }
   
}
