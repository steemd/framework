<?php

namespace CMS\Controller;

use Framework\Controller\Controller;
use Framework\Session\Session;
use Framework\DI\Service;
use Framework\Response\Response;
use Blog\Model\User;

/**
 * Description of ProfileController
 *
 * @author steemd
 */
class ProfileController extends Controller {

    function updateAction() {

        if ($this->getRequest()->isPost()) {
            try {
                $user           = new User();
                $user->id       = (int) $this->getRequest()->post('id');
                $user->email    = $this->getRequest()->post('email');
                $user->password = $this->getRequest()->post('password');
                $user->role     = 'ROLE_USER';
                $user->save();
                return $this->redirect($this->generateRoute('home'), 'The user data has been update successfully');
            } catch (DatabaseException $e) {
                $error = $e->getMessage();
            }
        }

        $user = User::findByEmail(Service::get('session')->userEmail);

        return $this->render('update.html', array(
                    'updateUser' => $user,
                    'action' => $this->generateRoute('profile'),
        ));
    }

}
