<?php

namespace Framework\Response;

use Framework\Response\Response;
/**
 * Description of JsonResponse
 *
 * @author steemd
 */
class RedirectResponse extends Response {
    
    private $url;
            
    function __construct($url = '/', $text = 'Redirect', $status = 303, $contentType = 'text/html; charset=utf-8') {
        $this->url = $url;
        $this->status = $status;
        $this->contentType = $contentType;
    }
    
    /**
     * generate response headers
     */
    public function getHeader(){
        header('HTTP/1.1 '.$this->status.' '.$this->statusText[$this->status]);
        header('Content-Type: '.$this->contentType);
        header('Location: /web'. $this->url);
    }

    /**
     * generate response content
     */
    public function getContent() {
        echo  '';
    } 
   
}
