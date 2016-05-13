<?php

/**
 * This file is part of the Slim Skeleton application.
 */

namespace app\lib;
use Interop\Container\ContainerInterface;


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
class AbstractController {

    const NAMESPACE_SEPARATOR = '\\';
    const MODEL_DIRECTORY_NAMESPACE = 'app\models';
    const POST_CONTROLLER_NAME = 'Controller';
    const POST_MODEL_NAME = 'Model';
    const VIEW_DIRECTORY_PATH = 'app/views';

    /**
     * @var ContainerInterface
     */
    protected $ci;

    /**
     * Class name of current Controller class.
     * Note that this is an abstract class and in this case only the caller
     * child class's name will be stored in this variable.
     *
     * @var string
     */
    protected $className;

    /**
     * Model instance which belongs to current controller.
     *
     * @var \app\lib\AbstractModel|null
     */
    protected $model;

    /**
     * View'content object that belongs to the controller.
     *
     * @var string|null
     */
    protected $content;

    /**
     * Construct
     * The class name is always the caller child class's name.
     * @param ContainerInterface $ci container interface
     */
    public function __construct(ContainerInterface $ci) {
        $this->ci = $ci;
        $this->className = (new \ReflectionClass($this))->getShortName();
        $this->setDefaultModel();
    }

    /**
     * Set model instance for this controller.
     *
     * @param Object $model under the app\models namespace
     */
    public function setModel($model) {
        $this->model = $model;
    }

    /**
     * Set the model instance of current controller automatically based on the controller's name.
     * If the model class exists the model instance will be set.
     */
    private function setDefaultModel() {
        $modelClass = self::MODEL_DIRECTORY_NAMESPACE . self::NAMESPACE_SEPARATOR .
            ucfirst(str_replace(self::POST_CONTROLLER_NAME, '', $this->className)) .
            self::POST_MODEL_NAME;
        if (class_exists($modelClass)) {
            $this->model = new $modelClass();
        }
    }

}
