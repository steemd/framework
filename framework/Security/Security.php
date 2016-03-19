<?php

namespace Framework\Security;

use Framework\Session\Session;
use Blog\Model\User;

/**
 * Description of Security
 *
 * @author steemd
 */
class Security {

    public function isAuthenticated(){
        if(Session::get('auth')){
            return true;
        } else {
            return false;
        }
    }
    
    public function setUser($user) {
        Session::set('userId', $user->id);
        Session::set('userEmail', $user->email);
        Session::set('userPass', $user->password);
        Session::set('userRole', $user->role);
        Session::set('auth', true);
    }
    
    public function getUser(){
        $user = new User();
        $user->email = Session::get('userEmail');
        $user->role = Session::get('userRole');
        return $user;
    }

        public function clear(){
        session_unset();
    }
    
}
