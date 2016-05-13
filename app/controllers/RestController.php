<?php

/**
 * This file is part of the Slim Skeleton application.
 */

namespace app\controllers;

use app\lib\AbstractController;
use app\models\ContentModel;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Description of RestController
 *
 * Basic Rest controller
 * The model is configured in the constructor.
 * 
 * @author Bóta László <bota.laszlo.dev@outlook.com>
 * @version 1.0
 * @see app\lib\AbstractController
 */
class RestController extends AbstractController {

    public function __construct(ContainerInterface $ci) {
        parent::__construct($ci);
        $this->model = new ContentModel();
    }

    /**
     * Get all items.
     *
     * @param Request $request
     * @param Response $response
     * @param mixed $args
     * @return Response object
     * @throws \RuntimeException
     */
    public function getAllItems($request, $response, $args) {
        return $response->withJson($this->model->findAll(), 200);
    }

    /**
     * Get one item.
     *
     * @param Request $request
     * @param Response $response
     * @param mixed $args
     * @return Response object
     * @throws \RuntimeException
     */
    public function getItem($request, $response, $args) {
        return $response->withJson($this->model->find((int) $args['id']), 201);
    }

    /**
     * Create item.
     *
     * @param Request $request
     * @param Response $response
     * @param mixed $args
     * @return Response object
     * @throws \RuntimeException
     */
    public function createItem($request, $response, $args) {
        $data = $request->getParsedBody();
        return $response->withJson($this->model->save($data['data']), 201);
    }

    /**
     * Edit item by id.
     *
     * @param Request $request
     * @param Response $response
     * @param mixed $args
     * @return Response object
     * @throws \RuntimeException
     */
    public function editItem($request, $response, $args) {
        $data = $request->getParsedBody();
        return $response->withJson($this->model->save($data['data'], (int) $args['id']), 204);
    }

    /**
     * Delete item by id.
     *
     * @param Request $request
     * @param Response $response
     * @param mixed $args
     * @return Response object
     * @throws \RuntimeException
     */
    public function deleteItem($request, $response, $args) {
        return $response->withJson($this->model->delete((int) $args['id']), 200);
    }
}
