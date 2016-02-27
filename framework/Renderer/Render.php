<?php

namespace Framework\Renderer;
/**
 * Description of Render
 *
 * @author steemd
 */
class Render {
    
    private $template;
    private $data;
    
    function __construct($template, $data) {
        $this->template = $template;
        $this->data=$data;         
    }
    
    public function send(){
        echo 'Template - '.$this->template;
        echo '<br />Data - '.$this->data;
    }
}
