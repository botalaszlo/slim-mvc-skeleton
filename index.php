<?php

/**
 * This file is part of the Slim Skeleton application.
 */

require 'vendor/autoload.php';

define('ENV', 'DEV');

if (ENV == 'DEV') {
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
}

$app = new \Slim\Slim();
$app->add(new \Slim\Middleware\ContentTypes());

require 'app/routes.php';

$app->run();
