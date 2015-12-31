<?php
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\Collection;

define('VERSION', 'v1');
define('ROOT_DIR', dirname( __FILE__ ));
define('DS', DIRECTORY_SEPARATOR);
try {
	include  ROOT_DIR . '/config/loader.php';
	include  ROOT_DIR . '/config/service.php';
	require ROOT_DIR . '/vendor/autoload.php';


	$app = new Micro($di);
	$app->setDI($di);

	$app->before(function() use ($app, $di) {

	});

	foreach($di->get('collections') as $collection){
		$app->mount($collection);
	}
	$app->handle();
} catch (Exception $e) {
	echo $e->getMessage();
    d($e->getTraceAsString());
}