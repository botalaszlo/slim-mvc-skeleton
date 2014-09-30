<?php

/**
 * This file is part of the Slim Skeleton application.
 */

namespace app\controllers;

use Slim\Slim;

/**
 * Description of AbstractController
 *
 * The basic controller class.
 * The slim and model objects are initalized.
 * 
 * @author Bóta László <bota.laszlo.dev@outlook.com>
 * @version 1.0
 * @see \Slim\Slim
 */
class BaseController extends Slim {

    /**
     * @var \app\models\AbstractModel
     */
    protected $model;

    public function __construct() {
        $settings = require(__DIR__ . '/../configurations/slim.php');
        parent::__construct($settings);
    }

    /**
     * Sending a response to the client side.
     * 
     * @param integer $statusCode
     * @param array $data {
     *     @type boolean $result
     *     @type string  $errorMessage
     * }
     */
    protected function sendResponse($statusCode, $data) {
        if (true === $data['result']) {
            $this->returnResponse($statusCode, null);
        } else {
            $this->returnResponse($statusCode, $data['errorMessage']);
        }
    }

    private function returnResponse($statusCode, $message = "") {
        // Via the BaseController, the halt method does not work.
        // It always returns with 200 status code and blank page.
        $slimInstance = Slim::getInstance();
        $slimInstance->halt($statusCode, $message);
    }

}
