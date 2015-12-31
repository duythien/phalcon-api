<?php

/**
 * Collections let us define groups of routes that will all use the same controller.
 * We can also set the handler to be lazy loaded.  Collections can share a common prefix.
 *
 * @link http://docs.phalconphp.com/en/latest/api/Phalcon_Mvc_Micro_Collection.html
 */
return call_user_func(function(){
    $testCollection = new \Phalcon\Mvc\Micro\Collection();

    $testCollection
        //VERSION NUMBER SHOULD BE FIRST URL PARAMETER, ALWAYS
        ->setPrefix('/' . VERSION . '/test')
        ->setHandler('Phanbook\Controllers\TestController')
        ->setLazy(true);

    // First paramter is the route, which with the collection prefix here would be GET /example/
    // Second paramter is the function name of the Controller.
    $testCollection->get('/', 'index');
    // This is exactly the same execution as GET, but the Response has no body.
    $testCollection->head('/', 'index');

    // $id will be passed as a parameter to the Controller's specified function
    $testCollection->get('/{id:[0-9]+}', 'getOne');
    $testCollection->head('/{id:[0-9]+}', 'getOne');
    $testCollection->post('/', 'post');
    $testCollection->delete('/{id:[0-9]+}', 'delete');
    $testCollection->put('/{id:[0-9]+}', 'put');
    $testCollection->patch('/{id:[0-9]+}', 'patch');

    return $testCollection;
});
