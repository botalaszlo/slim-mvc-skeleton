<?php

/**
 * This file is part of the Slim Skeleton application.
 * 
 * @author Bóta László <bota.laszlo.dev@outlook.com>
 * @version 1.0
 */

$app->get('/', function($request, $response, $args) {
    return $this->view->render($response, '/site/index.php');
});
$app->get('/doc', function($request, $response, $args) {
    return $this->view->render($response, '/site/doc.php');
});

// API group
$app->group('/api', function () use ($app) {
    // Sample URI-s for the content controller to show how use routes in Slim framework.
    // This should be removed for production environment.
    $app->group('/contents', function () {

        $this->get('', 'app\controllers\ContentController:getAllItems');
        $this->get('/', 'app\controllers\ContentController:getAllItems');

        $this->get('/{id}', 'app\controllers\ContentController:getItem');

        $this->post('', 'app\controllers\ContentController:createItem');
        $this->post('/', 'app\controllers\ContentController:createItem');

        $this->put('/{id}', 'app\controllers\ContentController:editItem');

        $this->delete('/{id}', 'app\controllers\ContentController:deleteItem');
    });
});
