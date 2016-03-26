<?php

namespace Framework\Security;

use Framework\Session\Session;
use Framework\DI\Service;
use Framework\Exception\RoleException;
use Framework\Request\Request;
use Framework\Exception\CustomException;

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
    public function isAuthenticated() {
        if (Session::get('auth')) {
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
    public function getUser() {
        $userClass = Service::get('config')['security']['user_class'];
        $user = new $userClass();
        $user->email = Session::get('userEmail');
        $user->role = Session::get('userRole');
        return $user;
    }

    /**
     * Clear User Session
     */
    public function clear() {
        session_unset();
    }

    /**
     * Verification user role
     * 
     * @throws RoleException
     */
    public function verifyUserRole() {

        $route = Service::get('route');
        if (isset($route['security'][0]) && !Service::get('session')->get('auth')) {

            if ($role == Service::get('session')->get('userRole')) {
                Session::set('returnUrl', str_replace('/web', '', $_SERVER['REDIRECT_URL']));
                throw new RoleException('You dont have anout permission to enter');
            }
        }
    }

    /**
     * Validation token
     * 
     * @throws Exception
     */
    public function verifyCsrfToken(){
        $request = new Request();
        
        if ($request->isPost() && $request->post('csrfToken')) {
            if ($request->post('csrfToken') !== Service::get('session')->csrfToken){
                throw new CustomException('Invalid token');
            }
        }
    }
    
    /**
     * Generate and return CSRF token
     * 
     * @return type
     */
    public function generateCsrfToken(){
        $csrfToken = md5('csrf_solt_string_'.uniqid());
        Session::set('csrfToken', $csrfToken);
        return $csrfToken;
    }
}
