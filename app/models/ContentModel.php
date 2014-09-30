<?php

/**
 * This file is part of the Slim Skeleton application.
 */

namespace app\models;

/**
 * Description of ContentModel
 *
 * Database operations on the content table.
 * This is only just an example model class.
 * The SQL query is under the data directory.
 * 
 * @author Bóta László <bota.laszlo.dev@outlook.com>
 * @version 1.0
 * @see app\models\BaseModel
 */
class ContentModel extends BaseModel {

    protected static $tableName = "tbl_contents";

    public function findAllItems() {
        $sql = "SELECT * FROM " . self::$tableName;
        return $this->findAll($sql);
    }

    public function findItem($id) {
        $sql = "SELECT * FROM " . self::$tableName . " WHERE id=:id LIMIT 1";
        return $this->find($sql, $id);
    }

    public function insertItem($data) {
        $sql = "INSERT INTO " . self::$tableName . "(title, content) " .
                "VALUES(:title, :content)";
        return $this->save($sql, $data);
    }

    public function updateItem($id, $data) {
        $sql = "UPDATE " . self::$tableName . " " .
                "SET title=:title, content=:content WHERE id=:id LIMIT 1";
        return $this->save($sql, $data, $id);
    }

    public function removeItem($id) {
        $sql = "DELETE FROM " . self::$tableName . " WHERE id=:id LIMIT 1";
        return $this->remove($sql, $id);
    }

}
