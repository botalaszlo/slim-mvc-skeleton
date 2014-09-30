<?php

/**
 * This file is part of the Slim Skeleton application.
 */

namespace app\controllers;

use app\controllers\BaseController;
use app\models\ContentModel;

/**
 * Description of RestController
 * 
 * This is a sample for the rest controller.
 * The model is configured in the constructor.
 * 
 * @author Bóta László <bota.laszlo.dev@outlook.com>
 * @version 1.0
 * @see BaseController
 */
class RestController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->model = new ContentModel();
    }

    public function getAllItem() {
        echo json_encode($this->model->findAllItems());
    }

    public function getItem($id) {
        echo json_encode($this->model->findItem($id));
    }

    public function createItem() {
        $data = $this->getRequestBody();
        $this->sendResponse(201, $this->model->insertItem($data['data']));
    }

    public function editItem($id) {
        $data = $this->getRequestBody();
        $this->sendResponse(204, $this->model->updateItem($id, $data['data']));
    }

    public function deleteItem($id) {
        $this->sendResponse(204, $this->model->removeItem($id));
    }

    protected function getRequestBody() {
        return $this->request->getBody();
    }

}
