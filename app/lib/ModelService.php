<?php
/**
 * Created by PhpStorm.
 * User: lacc
 * Date: 2016.05.13.
 * Time: 15:07
 */

namespace app\lib;


/**
 * Model service trait.
 * Provides database services. Generally this trait is used by the abstract Model class.
 *
 * @author Bóta László <bota.laszlo.dev@outlook.com>
 * @version 1.0
 */
trait ModelService {
    
    /**
     * Fetch all items from database.
     * The result object's type will be called class type via static call.
     *
     * @param string $query sql query
     * @return Object the result of query casted to called class type
     */
    protected static function fetchAllItems($query) {
        /** @var \PDOStatement $stmt */
        $stmt = self::$db->query($query);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        return $stmt->fetchAll();
    }
    
    /**
     * Fetch one item by id from database.
     * The result object's type will be called class type via static call.
     *
     * @param string $query sql query
     * @param integer $id
     * @return Object the result of query casted to called class type
     */
    protected static function fetchItem($query, $id) {
        /** @var \PDOStatement $stmt */
        $stmt = self::$db->prepare($query);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Insert model's data.
     *
     * @param mixed $data will be saved
     * @return mixed result info
     */
    protected function insertItem($data) {
        $sql = 'INSERT INTO ' . self::$tableName . '(' . $this->getInsertBindKeys($data) . ') ' .
            'VALUES(' . $this->getInsertValueKeys($data) . ')';
        return $this->saveItem($sql, $data);
    }

    /**
     * Update model with given data.
     *
     * @param integer $id of item
     * @param mixed $data will be saved
     * @return mixed result info
     */
    protected function updateItem($id, $data) {
        $sql = 'UPDATE ' . self::$tableName . ' ' .
            'SET ' . $this->getUpdateSetBindKeys($data) . ' WHERE id=:id LIMIT 1';
        return $this->saveItem($sql, $data, $id);
    }

    /**
     * Save item with data (by id)
     * If the $id is passed then it will be an update operation
     * else an insert operation.
     *
     * @param string $query sql query
     * @param array $data array of data
     * @param integer $id
     * @return mixed the result of sql query
     */
    private function saveItem($query, $data, $id = null) {
        $resultInfo = [];
        try {
            /** @var \PDOStatement $stmt */
            $stmt = self::$db->prepare($query);
            $this->bindValues($stmt, $data);
            // Update operation
            if (null !== $id) {
                $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
            }
            $stmt->execute();
            $resultInfo['result'] = true;
        } catch (\PDOException $ex) {
            $resultInfo = $this->setErrorResultInfo($ex->getMessage());
        }
        return $resultInfo;
    }

    /**
     * Removing item by id from database.
     *
     * @param string $query sql query
     * @param integer $id of item
     * @return mixed result information
     */
    protected function removeItem($query, $id) {
        $resultInfo = [];
        try {
            /** @var \PDOStatement $stmt */
            $stmt = self::$db->prepare($query);
            $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            $resultInfo['result'] = true;
        } catch (\PDOException $ex) {
            $resultInfo = $this->setErrorResultInfo($ex->getMessage());
        }
        return $resultInfo;
    }

    /**
     * Get PDO Insert binding keys:
     * <code>
     *  'id, name, etc'
     * </code>
     * @param mixed $data to save
     * @return string of insert operation's bind keys for PDO bind values
     */
    private function getInsertBindKeys($data) {
        return implode(', ', array_keys($data));
    }

    /**
     * Get PDO Insert value keys:
     * <code>
     *  ':id, :name, :etc'
     * </code>
     * @param mixed $data to save
     * @return string of insert operation's value keys for PDO bind values
     */
    private function getInsertValueKeys($data) {
        return ':' . implode(', :', array_keys($data));
    }

    /**
     * Get PDO Update value keys for set:
     * <code>
     *  'id=:id, name=:name, etc=:etc'
     * </code>
     * @param mixed $data to save
     * @return string of update operation's bind keys for PDO bind values
     */
    private function getUpdateSetBindKeys($data) {
        $updateBindKeysArray = [];
        foreach (array_keys($data) as $propertyKey) {
            $updateBindKeysArray[] = $propertyKey . '=:' . $propertyKey;
        }
        return implode(', ', $updateBindKeysArray);
    }

    /**
     * Binding values to the sql query parameters
     *
     * @param \PDO $stmt database object
     * @param array $data of the parameters.
     */
    private function bindValues(&$stmt, $data) {
        foreach ($data as $key => $value) {
            $value = array_key_exists($key, $data) || $data[$key] === '' ? $value : null;
            /** @var \PDOStatement $stmt */
            $stmt->bindValue(':' . $key, $value);
        }
    }

    /**
     * Set the error result informations.
     *
     * @param string $message of errors
     * @return mixed $resultInfo information about result
     */
    private function setErrorResultInfo($message) {
        $resultInfo['result'] = false;
        $resultInfo['errorMessage'] = $message;
        return $resultInfo;
    }
}