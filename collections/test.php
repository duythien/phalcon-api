<?php

/**
 * Collections let us define groups of routes that will all use the same controller.
 * We can also set the handler to be lazy loaded.  Collections can share a common prefix.
 *
 * @link http://docs.phalconphp.com/en/latest/api/Phalcon_Mvc_Micro_Collection.html
 */
return call_user_func(
    function () use ($router, $controllerNamespace){
        $router
            ->setPrefix( '/'. VERSION . '/test')
            ->setHandler($controllerNamespace . 'TestController')
            ->setLazy(true);

        // First paramter is the route, which with the collection prefix here would be GET /example/
        // Second paramter is the function name of the Controller.
        $router->get('/', 'index');
        $router->get('/model', 'model');

        // This is exactly the same execution as GET, but the Response has no body.
        //$testCollection->head('/', 'index');

        // $id will be passed as a parameter to the Controller's specified function
        // $testCollection->get('/{id:[0-9]+}', 'getOne');
        // $testCollection->head('/{id:[0-9]+}', 'getOne');
        // $testCollection->delete('/{id:[0-9]+}', 'delete');
        // $testCollection->put('{id:[0-9]+}', 'put');
        // $testCollection->patch('{id:[0-9]+}', 'patch');
        // //
        // $testCollection->map('token', 'token');
        // $testCollection->get('get/token', 'getToken');
        // $testCollection->map('authorize', 'authorize');
        //d($testCollection);
        return $router;
    }
);
