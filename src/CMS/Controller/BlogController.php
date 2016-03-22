<?php

namespace CMS\Controller;

use Framework\Controller\Controller;
use Blog\Model\Post;
use Framework\Validation\Validator;
use Framework\Exception\HttpNotFoundException;
/**
 * Description of BlogController
 *
 * @author steemd
 */
class BlogController extends Controller {
    
    function editAction($id){

        if ($this->getRequest()->isPost()) {
            try{
                $post          = new Post();
                $date          = new \DateTime();
                $post->id      = (int) $id;
                $post->title   = $this->getRequest()->post('title');
                $post->content = trim($this->getRequest()->post('content'));
                $post->date    = $date->format('Y-m-d H:i:s');

                $validator = new Validator($post);
                if ($validator->isValid()) {
                    $post->save();
                    return $this->redirect($this->generateRoute('home'), 'The data has been update successfully');
                } else {
                    $error = $validator->getErrors();
                }
            } catch(DatabaseException $e){
                $error = $e->getMessage();
            }
        }
        
        if (!$post = Post::find((int)$id)) {
            throw new HttpNotFoundException('Page Not Found!');
        }
        
        return $this->render('edit.html', array(
            'post' => $post, 
            'action' => $this->generateRoute('edit_post', $post->id), 
            'errors' => isset($error)?$error:null)
                );
    }
    
    function listAction(){
       return $this->render('list.html', array('posts' => Post::find('all')));
    }
}
