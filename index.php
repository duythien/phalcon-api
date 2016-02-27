<?php
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\Collection;

define('DS', DIRECTORY_SEPARATOR);
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

	$app->before(function() use ($app, $di) {

	});
	foreach($di->get('collections') as $collection){
		$app->mount($collection);
	}
    /**
     * After a route is run, usually when its Controller returns a final value,
     * the application runs the following function which actually sends the response to the client.
     *
     * The default behavior is to send the Controller's returned value to the client as JSON.
     * However, by parsing the request querystring's 'type' paramter, it is easy to install
     * different response type handlers.  Below is an alternate csv handler.
     */
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
	$app->handle();
} catch (Exception $e) {
	echo $e->getMessage();
    d($e->getTraceAsString());
}
