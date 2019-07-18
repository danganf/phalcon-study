<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
    ]
)->register();

$loader->registerNamespaces([
    'Phalcon' => BASE_PATH . '/vendor/incubator/Library/Phalcon/'
] )->register();

$di->set(
    'helper',
    function () {
        return new \App\Custom\CustomHelper();
    },
    true
);
