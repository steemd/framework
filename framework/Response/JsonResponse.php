<?php

namespace Framework\Response;

use Framework\Response\Response;
/**
 * Its JsonResponse Class to return JSON resalt to browser
 * 
 * @author steemd
 */
class JsonResponse extends Response {
    
    /**
     * Constructor init Object and add properties
     * 
     * @param type $content
     * @param type $status
     * @param type $contentType
     */
    function __construct($content = '', $status = 200, $contentType = 'application/json; charset=utf-8') {
        $this->status = $status;
        $this->content = $content;
        $this->contentType = $contentType;
    }

    /**
     * generate response content
     */
    public function getContent() {
        echo json_encode($this->content, JSON_UNESCAPED_UNICODE);
    } 
   
}
