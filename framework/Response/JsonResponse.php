<?php

namespace Framework\Response;

use Framework\Response\Response;
/**
 * Description of JsonResponse
 *
 * @author steemd
 */
class JsonResponse extends Response {
            
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
