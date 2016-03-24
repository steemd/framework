<?php

namespace Framework\Validation\Filter;

/**
 * Description of Length
 *
 * @author steemd
 */
class Length {
    
    /**
     * @var int $min
     */
    private $min;
    
    /**
     * @var int $max
     */
    private $max;
         
    /**
     * Save diapason of data
     * 
     * @param type $min
     * @param type $max
     */
    function __construct($min, $max) {
        $this->min = $min;
        $this->max = $max;
    }
    
    /**
     * Return resalt of valid data 
     * 
     * @param type $data
     * @param type $name
     * 
     * @return array() resalt
     */
    function isValid($data, $name){
        $len = strlen($data);
        if ($len >= $this->min && $len <= $this->max){    
            return array(true);
        } else {
            return array(false, $name.' length must be in more ('.$this->min.') and less ('.$this->max.')');
        }
    }
}
