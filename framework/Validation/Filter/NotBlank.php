<?php

namespace Framework\Validation\Filter;

/**
 * Description of NotBlank
 *
 * @author steemd
 */
class NotBlank {
    
    /**
     * Return resalt of valid data 
     * 
     * @param type $data
     * @param type $name
     * 
     * @return array() resalt
     */
    function isValid($data, $name){
        if(strlen($data)>0) {
            return array(true);
        } else {
            return array(false, $name.' must be not blank data');
        }
    }
}
