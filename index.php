<?php
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\Collection;

define('DS', DIRECTORY_SEPARATOR);
define('VERSION', 'v1');
define('ROOT_DIR', dirname(__FILE__) . DS);
define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'local'));

use Phanbook\Responses\XmlResponse;
use Phanbook\Responses\JsonResponse;

try {

	require  ROOT_DIR . 'config/loader.php';
	require  ROOT_DIR . 'config/service.php';
	require  ROOT_DIR . 'vendor/autoload.php';

	$app = new Micro($di);
	$app->setDI($di);

    //Before executing the handler. It can be used to control the access to the application
	$app->before(function() use ($app, $di) {

	});
	foreach($di->get('collections') as $collection){
		$app->mount($collection);
	}
    //Executed after the handler is executed. It can be used to prepare the response
    $app->after(function() use ($app) {
        $type = $app->request->get('type');
        switch ($type) {
            case 'xml':
                $response = new XmlResponse;
                //@response->setSomthing()
                break;
            case 'csv':
                # code...
                break;
            default:
                $response = new JsonResponse;
                break;
        }
    });

    //Executed after sending the response. It can be used to perform clean-up
    $app->finish(function () use ($app) {

    });
    //When a user tries to access a route that is not defined
    $app->notFound(function () use ($app) {
        $app->response->setStatusCode(404, "Not Found")->sendHeaders();
        echo 'This is crazy, but this page was not found!';
    });
	$app->handle();
} catch (Exception $e) {
	echo $e->getMessage();
    d($e->getTraceAsString());
}
