<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Framework\Exception;

use Framework\Renderer\Renderer;
/**
 * Description of HttpNotFoundException
 *
 * @author steemd
 */
class HttpNotFoundException extends \Exception {
    
    function getRenderContent($title = '404 Error') {
        $renderer = new Renderer('show.html', array('title' => $title, 'message' => $this->getMessage()), 'Blog\\Controller\\ExceptionController');
        $result = $renderer->renderContent();
        return $result;
        
    }
}
