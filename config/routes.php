<?php

/**
 * routeLoader loads a set of Phalcon Mvc\Micro\Collections from
 * the collections directory.
 *
 * php files in the collections directory must return Collection objects only.
 */
return call_user_func(
    function () {

        $collections         = array();
        $collectionFiles     = scandir(ROOT_DIR . 'collections');
        $controllerNamespace = '\App\\Controllers\\';
        $router = new \Phalcon\Mvc\Micro\Collection();

        foreach ($collectionFiles as $collectionFile) {
            $pathinfo = pathinfo($collectionFile);
            if ($pathinfo['extension'] === 'php') {
                // The collection files return their collection objects, so mount
                // them directly into the router.
                $collections[] = include ROOT_DIR . 'collections/' . $collectionFile;
            }
        }
        return $collections;
    }
);
