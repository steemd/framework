<?php

namespace Framework\Request;

/**
 * Request return Fet and Post data
 *
 * @author steemd
 */
class Request {
    
    /**
     * Class constructor
     */
    function __construct() {
    }
    
    /**
     * Method return Post status
     * 
     * @return boolean
     */
    public function isPost(){
        return false;
    }
}
