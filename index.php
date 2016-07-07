<?php
use Phalcon\Mvc\Application;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(__FILE__) . DS);

try {

    require  ROOT_DIR . 'config/loader.php';
    require  ROOT_DIR . 'config/service.php';
    require  ROOT_DIR . 'vendor/autoload.php';

    $router = $di->getRouter();
    $router->handle();

    // Pass the processed router parameters to the dispatcher
    $dispatcher = $di->getDispatcher();
    $dispatcher->setControllerName($router->getControllerName());
    $dispatcher->setActionName($router->getActionName());
    $dispatcher->setParams($router->getParams());
    $dispatcher->dispatch();

    // Get the returned value by the last executed action
    $response = $dispatcher->getReturnedValue();
    // Check if the action returned is a 'response' object
    if ($response instanceof Phalcon\Http\ResponseInterface) {
        // Send the response
        $response->send();
    }
} catch (Exception $e) {
    echo $e->getMessage();
    d($e->getTraceAsString());
}

