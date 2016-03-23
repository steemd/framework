<?php

namespace Framework\Security;

use Framework\Session\Session;
use Framework\DI\Service;

/**
 * Description of Security
 *
 * @author steemd
 */
class Security {

    /**
     * Method isAuthenticated
     * 
     * @return boolean
     */
    public function isAuthenticated(){
        if(Session::get('auth')){
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Set User to Session
     * 
     * @param type $user
     */
    public function setUser($user) {   
        Session::set('userEmail', $user->email);
        Session::set('userRole', $user->role);
        Session::set('auth', true);
    }
    
    /**
     * Return User object
     * 
     * @return \Framework\Security\userClass
     */
    public function getUser(){
        $userClass = Service::get('config')['security']['user_class'];
        $user = new $userClass();
        $user->email = Session::get('userEmail');
        $user->role = Session::get('userRole');
        return $user;
    }

    /**
     * Clear User Session
     */
    public function clear(){
        session_unset();
    }
    
}
