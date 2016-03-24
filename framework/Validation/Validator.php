<?php

namespace Framework\Validation;

use Framework\Request\Request;
use Framework\Session\Session;
use Framework\DI\Service;

/**
 * Description of Validator
 *
 * @author steemd
 */
class Validator {

    /**
     * @var object $obj
     */
    private $obj;
    /**
     * @var array() $errors
     */
    private $errors = array();

    /**
     * Construct data object
     * 
     * @param type $obj
     */
    function __construct($obj) {
        $this->obj = $obj;
    }

    /**
     * Validate method
     * 
     * @return boolean
     */
    public function isValid() {
        $res = true;
        $errors = array();
        $data = get_object_vars($this->obj);
        $rules = $this->obj->getRules();

        foreach ($rules as $key => $arr) {
            foreach ($arr as $val) {
                $errors[$key] = $val->isValid($data[$key], $key);
            }
        }

        foreach ($errors as $name => $status) {
            if (!$status[0]) {
                $res = false;
                $this->errors[$name] = $status[1];
            }
        }

        if ($token = $this->validToken()) {
            $res = false;
            $this->errors['token'] = $token;
        }

        return $res;
    }

    /**
     * Validate token data
     * 
     * @return boolean|string
     */
    private function validToken() {
        $request = new Request();
        $fromPost = $request->post('token');
        $fromCookie = Session::get('token');
        unset(Service::get('session')->token);

        if ($fromPost !== $fromCookie) {
            return 'Not valid token data';
        } else {
            return false;
        }
    }

    /**
     * Create throw if object is no valid
     * 
     * @throws \Exception
     */
    public function getErrors() {
        return $this->errors;
    }

}
