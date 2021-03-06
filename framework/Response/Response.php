<?php

namespace Framework\Response;

/**
 * Its base Response Class to return resalt of action
 *
 * @author steemd
 */
class Response {
    
    /**
     * @var number $status
     */
    protected $status;
    
    /**
     * @var array  $statusText
     */
    protected $statusText = array(
        '200' => 'OK',
        '303' => 'See Other',
        '404' => 'Not Found',
        '500' => 'Internal Server Error',
        );
    
    /**
     * @var text $content
     */
    protected  $content;
    
    /**
     * @var text $contentType
     */
    protected  $contentType;

    /**
     * Constructor init default properties
     * 
     * @param type $content
     * @param type $status
     * @param type $contentType
     */
    function __construct($content = '', $status = 200, $contentType = 'text/html; charset=utf-8') { 
        $this->content = $content;
        $this->status = $status;
        $this->contentType = $contentType;
    }

    /**
     * generate response headers
     */
    public function getHeader(){
        header('HTTP/1.1 '.$this->status.' '.$this->statusText[$this->status]);
        header('Content-Type: '.$this->contentType);
    }

    /**
     * generate response content
     */
    public function getContent() {
        echo $this->content;
    }
    
    /** 
     * method sent information on user display
     */
    public function send(){
        $this->getHeader();
        $this->getContent();        
    }
}
