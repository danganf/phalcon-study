<?php

use Phalcon\Mvc\Router;

$router = new Router();

$router->add('/'                , ['controller' => 'index'  ,'action' => 'index']);
$router->add('/authors'         , ['controller' => 'authors','action' => 'index']);
$router->addPost('/authors'     , ['controller' => 'authors','action' => 'save']);
$router->addPut('/authors/{oid}', ['controller' => 'authors','action' => 'update']);

return $router;
