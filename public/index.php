<?php

use Phalcon\Di\FactoryDefault;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Handle routes
     */
    include APP_PATH . '/config/router.php';

    /**
     * Read services
     */
    include APP_PATH . '/config/services.php';

    if(!extension_loaded("mongodb")) throw new \Exception("Mongo DB extension is not installed for PHP");

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();
    $di->getHelper();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    $di->set('router', function() {
        return include __DIR__ . '/../app/config/router.php';
    }, true);

    //MongoDB Database
    $di->set('MongoDB', function () use ($config) {
        $mongoClient = new \Phalcon\Db\Adapter\MongoDB\Client("mongodb://127.0.0.1:27017");
        exit(var_dump($mongoClient->selectDatabase('music')));
        return $mongoClient->selectDatabase('music'); // unchanged
    }, TRUE);

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
