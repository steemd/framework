<?php

namespace Framework\Controller;

use Framework\Renderer\Render;
/**
 * Description of Controller
 *
 * @author steemd
 */
class Controller {
    
    public function render($template, $data){
        return new Render($template, $data);
    }
}
