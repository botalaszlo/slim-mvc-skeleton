<?php

/**
 * This file is part of the Slim Skeleton application.
 * 
 * @author Bóta László <bota.laszlo.dev@outlook.com>
 * @version 1.0
 */

use app\controllers\SiteController;
use app\controllers\RestController;

\Slim\Route::setDefaultConditions(array(
    'id' => '\d+'
));

$app->get('/', function() {
	$siteController = new SiteController();
	$siteController->index();
});
$app->get('/doc', function() {
	$siteController = new SiteController();
	$siteController->documentation();
});

// API group
$app->group('/api', function () use ($app) {
    // Sample rest uri
    $app->group('/contents', function () use ($app) {

        $restController = new RestController();

        $app->get('/', function () use ($restController) {
            $restController->getAllItem();
        })->via('get');

        $app->get('/:id', function ($id) use ($restController) {
            $restController->getItem($id);
        })->via('get');

        $app->post('/', function () use ($restController) {
            $restController->createItem();
        })->via('post');

        $app->put('/:id', function ($id) use ($restController) {
            $restController->editItem($id);
        })->via('put');

        $app->delete('/:id', function ($id) use ($restController) {
            $restController->deleteItem($id);
        })->via('delete');
    });
});
