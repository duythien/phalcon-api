<?php

use Phalcon\DI;
use Phalcon\Crypt;
use Phalcon\Security;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;
use Phalcon\Http\Response\Cookies;
use Phalcon\Cache\Frontend\Data;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Cache\Backend\Memcache;
use Phalcon\Translate\Adapter\Gettext;
use Phalcon\Cache\Backend\Libmemcached;
use Phalcon\Mvc\Model\Manager as ModelsManager;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Dispatcher;
use App\Auth\OAuth;

/**
 * The FactoryDefault Dependency Injector automatically
 * register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Register the configuration itself as a service
 */
$config = include __DIR__ . '/config.php';
$di->set('config', $config, true);

//setup timezone
//date_default_timezone_set($di->get('config')->application->timezone ?: 'UTC');

/**
 * Router
 */
$di->set(
    'router',
    function () {
        return include __DIR__ . '/routes.php';
    },
    true
);

$di->set(
    'dispatcher',
    function () use ($di) {
        $eventsManager = new EventsManager;
        //$eventsManager->attach('dispatch', new Acl());
        //$eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);
        $dispatcher = new Dispatcher;
        $dispatcher->setEventsManager($eventsManager);
        $dispatcher->setDefaultNamespace('App\\Controllers');
        return $dispatcher;
    }
);

/**
 * This service controls the initialization of models, keeping record of relations
 * between the different models of the application.
 */
$di->set(
    'collectionManager',
    function () {
        return new Manager();
    }
);
$di->set(
    'modelsManager',
    function () {
        return new ModelsManager();
    }
);


// Database connection is created based in the parameters defined in the configuration file
$di->set(
    'db',
    function () use ($di) {
        return new Mysql(
            [
                'host'     => $di->get('config')->database->mysql->host,
                'username' => $di->get('config')->database->mysql->username,
                'password' => $di->get('config')->database->mysql->password,
                'dbname'   => $di->get('config')->database->mysql->dbname,
                'options'  => [
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $di->get('config')->database->mysql->charset
                ]
            ]
        );
    },
    true // shared
);

$di->set(
    'cookies',
    function () {
        $cookies = new Cookies();
        $cookies->useEncryption(false);
        return $cookies;
    },
    true
);

$di->set(
    'security',
    function () {

        $security = new Security();
        //Set the password hashing factor to 12 rounds
        $security->setWorkFactor(12);

        return $security;
    },
    true
);

//Set the models cache service
$di->set(
    'modelsCache',
    function () {

        //Cache data for one day by default
        $frontCache = new Data(
            array(
            "lifetime" => 86400
            )
        );

        //Memcached connection settings
        $cache = new Memcache(
            $frontCache,
            array(
            "host" => "localhost",
            "port" => "11211"
            )
        );

        return $cache;
    }
);

//Oauth
$di->set(
    'oauth',
    function () {
        $oauth = new OAuth();
        return $oauth;

    },
    true
);

//Phalcon Debugger
if ($config->application->debug) {
    (new \Phalcon\Debug)->listen();
    include ROOT_DIR . 'common/tools/Debug.php';
}
