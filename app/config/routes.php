<?php

return array(
    'home'           => array(
        'pattern'    => '/',
        'controller' => 'Blog\\Controller\\PostController',
        'action'     => 'index'
    ),
    'testredirect'   => array(
        'pattern'    => '/test_redirect',
        'controller' => 'Blog\\Controller\\TestController',
        'action'     => 'redirect',
    ),
    'test_json' => array(
        'pattern'    => '/test_json',
        'controller' => 'Blog\\Controller\\TestController',
        'action'     => 'getJson',
    ),
    'signin'         => array(
        'pattern'    => '/signin',
        'controller' => 'Blog\\Controller\\SecurityController',
        'action'     => 'signin'
    ),
    'login'          => array(
        'pattern'    => '/login',
        'controller' => 'Blog\\Controller\\SecurityController',
        'action'     => 'login'
    ),
    'logout'         => array(
        'pattern'    => '/logout',
        'controller' => 'Blog\\Controller\\SecurityController',
        'action'     => 'logout'
    ),
    'update_profile' => array(
        'pattern'       => '/profile',
        'controller'    => 'CMS\\Controller\\ProfileController',
        'action'        => 'update',
        'security'   => array('ROLE_USER'),
        '_requirements' => array(
            '_method' => 'POST'
        )
    ),
    'profile'        => array(
        'pattern'    => '/profile',
        'controller' => 'CMS\\Controller\\ProfileController',
        'action'     => 'get',
        'security'   => array('ROLE_USER'),
    ),
    'add_post'       => array(
        'pattern'    => '/posts/add',
        'controller' => 'Blog\\Controller\\PostController',
        'action'     => 'add',
        'security'   => array('ROLE_USER'),
    ),
    'show_post'      => array(
        'pattern'       => '/posts/{id}',
        'controller'    => 'Blog\\Controller\\PostController',
        'action'        => 'show',
        '_requirements' => array(
            'id' => '\d+'
        )
    ),
    'edit_post'      => array(
        'pattern'       => '/posts/{id}/edit',
        'controller'    => 'CMS\\Controller\\BlogController',
        'action'        => 'edit',
        'security'   => array('ROLE_USER'),
        '_requirements' => array(
            'id'      => '\d+',
            '_method' => 'POST'
        )
    ),
    'list_post'      => array(
        'pattern'       => '/posts/list',
        'controller'    => 'CMS\\Controller\\BlogController',
        'action'        => 'list',
        'security'   => array('ROLE_USER'),
    ),
    'remove_post'      => array(
        'pattern'       => '/posts/{id}/remove',
        'controller'    => 'CMS\\Controller\\BlogController',
        'action'        => 'remove',
        'security'   => array('ROLE_USER'),
         '_requirements' => array(
            'id' => '\d+'
        )
    ),
);