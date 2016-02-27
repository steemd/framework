<?php

namespace Framework\Response;

/**
 * Its base Response Class to return resalt of action
 *
 * @author steemd
 */
class Response {
    
    protected $statusCode = '200';
    protected $statusText = array(
        '200' => 'OK',
        '404' => 'Page Not Found',
        );
    
    function __construct() {   
    }

    private function getHeader(){
    }

    private function getContent() {
    }

    public function send(){
        echo '<br /><br />Some Text from Response';
    }
}
