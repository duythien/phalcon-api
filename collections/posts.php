<?php

/**
 * Collections let us define groups of routes that will all use the same controller.
 * We can also set the handler to be lazy loaded.  Collections can share a common prefix.
 *
 * @link http://docs.phalconphp.com/en/latest/api/Phalcon_Mvc_Micro_Collection.html
 */
return call_user_func(
    function () {
        $collection = new \Phalcon\Mvc\Micro\Collection();

        $collection
            ->setPrefix('/posts')
            ->setHandler('Phanbook\Controllers\PostsController')
            ->setLazy(true);
        $collection->get('/', 'index');
        $collection->head('/', 'index');

        // $id will be passed as a parameter to the Controller's specified function
        $collection->get('/{id:[0-9]+}', 'getOne');
        $collection->head('/{id:[0-9]+}', 'getOne');
        $collection->post('/', 'post');
        $collection->delete('/{id:[0-9]+}', 'delete');
        $collection->put('/{id:[0-9]+}', 'put');
        $collection->patch('/{id:[0-9]+}', 'patch');
        $collection->get('/mysql', 'mysql');

        return $collection;
    }
);
