<?php

/**
 * This file is part of the Slim Skeleton application.
 */

require __DIR__ . '/vendor/autoload.php';

/**
 * Environment settings [Developing, Production]
 */
define('ENV', 'DEV');

if (ENV === 'DEV') {
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
}

/**
 * Slim framework bootstrapping
 */
$settings = require __DIR__ . '/app/configs/slim.php';

$app = new \Slim\App(['settings' => $settings]);
/** @var mixed $container */
$container = $app->getContainer();
$container['view'] = function ($container) {
    return new \Slim\Views\PhpRenderer('app/views');
};
require __DIR__ . '/app/routes.php';
$app->run();
