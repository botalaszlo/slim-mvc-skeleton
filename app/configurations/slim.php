<?php

/**
 * This file is part of the Slim Skeleton application.
 */

$mode = ENV == 'DEV' ? 'development' : 'production';
$debug = ENV == 'DEV' ? true : false;

return array(
    'mode' => $mode,
    'debug' => $debug,
    'templates.path' => __DIR__ . '/../views'
);
