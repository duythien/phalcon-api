<?php

use Phalcon\Mvc\Router\Group;
use Phalcon\Mvc\Router;

$router = new Router(false);
$router->setDefaults([
    'controller' => 'tests',
    'action'     => 'index'
]);
$router->removeExtraSlashes(true);
$prefix = '/' . VERSION . '/';
//tests
$tests = new Group(['controller' => 'tests']);
$tests->setPrefix($prefix . 'tests');
$tests->addGet('', ['action' => 'index']);
$tests->addGet('/{id:[0-9]+}', ['action' => 'view']);
$tests->addPost('/new', ['action' => 'new']);
$tests->addPut('/{id:[0-9]+}', ['action' => 'update']);


//task
$tasks = new Group(['controller' => 'task']);
$tasks->setPrefix($prefix . 'tasks');
$tasks->addGet('', ['action' => 'index']);
$tasks->addGet('/{id:[0-9]+}', ['action' => 'view']);
$tasks->addPost('/new', ['action' => 'new']);
$tasks->addPut('/{id:[0-9]+}', ['action' => 'update']);

//token
$token = new Group(['controller' => 'token']);
$token->setPrefix($prefix . 'token');
$token->add('',['action' => 'index']);

//mount
$router->mount($token);
$router->mount($tests);
$router->mount($tasks);

return $router;
