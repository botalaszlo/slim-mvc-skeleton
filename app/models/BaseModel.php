<?php

/**
 * This file is part of the Slim Skeleton application.
 */

namespace app\models;

/**
 * Description of AbstractModel
 *
 * The basic abstract class for every model classes.
 * The \PDO object is initalized here for the children classes.
 * Basic database operations are provided.
 * 
 * @author Bóta László <bota.laszlo.dev@outlook.com>
 * @version 1.0
 */
class BaseModel {

    /**
     * @var \PDO
     */
    protected static $db;

    /**
     * @var mixin
     */
    private $resultInfo;

    public function __construct() {
        $settings = require(__DIR__ . '/../configurations/database.php');
        self::initDatabase($settings);
    }

    private static function initDatabase($config) {
        if (!self::$db instanceof \PDO) {
            self::$db = new \PDO(
                    'mysql:host=' . $config["database"]["host"] . ';dbname=' . $config["database"]["db_name"] . ';charset=utf8', $config["database"]["username"], $config["database"]["password"]
            );
            self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }

    /**
     * Find all item
     * 
     * @param string $sql query
     * @return array the result of query
     */
    protected function findAll($sql) {
        $stmt = self::$db->query($sql);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Find one item by id
     * 
     * @param string $sql query
     * @param integer $id
     * @return array the result of query
     */
    protected function find($sql, $id) {
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Save item with data (by id)
     * If the $id is passed then it will be an update operation
     * else an insert operation.
     * 
     * @param string $sql query
     * @param array $data array of data
     * @param integer $id
     * @return array the result of sql query
     */
    protected function save($sql, $data, $id = null) {
        try {
            $stmt = self::$db->prepare($sql);
            $this->bindValues($stmt, $data);
            // Update operation
            if (null != $id) {
                $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
            }
            $stmt->execute();
            $this->resultInfo['result'] = true;
        } catch (\PDOException $ex) {
            $this->setErrorResultInfo($ex->getMessage());
        }

        return $this->resultInfo;
    }

    /**
     * Removing item by id
     * 
     * @param string $sql query
     * @param integer $id
     * @return array result of sql query.
     */
    protected function remove($sql, $id) {
        try {
            $stmt = self::$db->prepare($sql);
            $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            $this->resultInfo['result'] = true;
        } catch (\PDOException $ex) {
            $this->setErrorResultInfo($ex->getMessage());
        }

        return $this->resultInfo;
    }

    /**
     * Binding values to the sql query parameters
     * 
     * @param \PDO $stmt database object
     * @param array $data of the parameters.
     */
    protected function bindValues(&$stmt, $data) {
        foreach ($data as $key => $value) {
            $value = (isset($data[$key]) || $data[$key] == "" ? $value : null);
            $stmt->bindValue(':' . $key, $value);
        }
    }

    private function setErrorResultInfo($message) {
        $this->resultInfo['result'] = false;
        $this->resultInfo['errorMessage'] = $message;
    }

}
