<?php

namespace CMS\Controller;

use Framework\Controller\Controller;
use Framework\Session\Session;
use Framework\Response\Response;
/**
 * Description of ProfileController
 *
 * @author steemd
 */
class ProfileController extends Controller  {
    
    function __construct() {
        //
    }
    
    function updateAction(){
        return new Response('Profile - update');
    }
}
