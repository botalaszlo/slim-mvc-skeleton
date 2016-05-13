<?php

/**
 * This file is part of the Slim Skeleton application.
 */

namespace app\lib;

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
abstract class AbstractModel {

    const POST_MODEL_NAME = 'Model';

    /**
     * Use model service trait.
     */
    use ModelService;

    /**
     * Class name of current Controller class.
     * Note that this is an abstract class and in this case only the caller
     * child class's name will be stored in this variable.
     *
     * @var string
     */
    protected static $className;

    /**
     * @var string class name with namespace
     */
    protected static $classByNamespace;

    /**
     * @var \PDO database instance
     */
    protected static $db;

    /**
     * @var string the current model's table name
     */
    protected static $tableName;


    public function __construct() {
        self::$classByNamespace = (new \ReflectionClass($this))->getName();
        self::$className = (new \ReflectionClass($this))->getShortName();
        $settings = require __DIR__ . '/../configs/database.php';
        self::initDatabase($settings['database']);
        self::initTableName($settings['database']);
    }

    /**
     * Initialise the database.
     *
     * @param mixed $databaseConfig the database config
     */
    private static function initDatabase($databaseConfig) {
        if (!self::$db instanceof \PDO) {
            self::$db = new \PDO(
                'mysql:host=' . $databaseConfig['host'] .
                ';dbname=' . $databaseConfig['db_name'] .
                ';charset=utf8', $databaseConfig['username'], $databaseConfig['password']
            );
            self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }

    /**
     * Get table name by the class name.
     *
     * @param string $className class name
     * @return string name of the table
     */
    public static function getTableNameByClassName($className) {
        $lastBackSlash = strrpos($className, '\\');
        if (false !== $lastBackSlash) {
            $className = substr($className, $lastBackSlash + 1);
        }
        return self::pluralize(2, strtolower(str_replace(self::POST_MODEL_NAME, '', $className)));
    }

    /**
     * Initialise the table's name based on the model's name.
     * If a table prefix name configured then it will attached to begin of table name.
     *
     * @param mixed $databaseConfig
     */
    private static function initTableName($databaseConfig) {
        self::$tableName = self::getTableNameByClassName(self::$className);
        if (isset($databaseConfig['tablePrefix'])) {
            self::$tableName = $databaseConfig['tablePrefix'] . self::$tableName;
        }
    }

    /**
     * Pluralizes a word if quantity is not one.
     *
     * @link http://stackoverflow.com/questions/1534127/pluralize-in-php#answer-16925755 from stackoverflow
     * @param int $quantity Number of items
     * @param string $singular Singular form of word
     * @param string $plural Plural form of word; function will attempt to deduce plural form from singular if not provided
     * @return string Pluralized word if quantity is not one, otherwise singular
     */
    private static function pluralize($quantity, $singular, $plural = null) {
        if ($quantity === 1 || $singular === '') {
            return $singular;
        }
        if ($plural !== null) {
            return $plural;
        }
        $last_letter = strtolower($singular[strlen($singular) - 1]);
        switch ($last_letter) {
            case 'y':
                return substr($singular, 0, -1) . 'ies';
            case 's':
                return $singular . 'es';
            default:
                return $singular . 's';
        }
    }
    
    /**
     * Find all items.
     *
     * @return array the result of query
     */
    public static function findAll() {
        $sql = 'SELECT * FROM ' . self::$tableName;
        return self::fetchAllItems($sql);
    }
    
    /**
     * Find one item by id.
     *
     * @param integer $id
     * @return array the result of query
     */
    public static function find($id) {
        $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE id=:id LIMIT 1';
        return self::fetchItem($sql, $id);
    }

    /**
     * Save the current model.
     * The properties of model collected itself automatically and save during
     * the database operation.
     *
     * @param mixed $data to save
     * @param integer|null $id of database record
     * @return false|mixed result information and false if the saving not possible
     * because the model's properties are not available.
     */
    public function save($data, $id = null) {
        if ($data === null || empty($data)) {
            return false;
        }
        if ($id === null || $id < 1) {
            return $this->insertItem($data);
        } else {
            return $this->updateItem($id, $data);
        }
    }

    /**
     * Remove model from database.
     *
     * @param integer $id of model
     * @return mixed result info
     */
    public function delete($id) {
        $sql = 'DELETE FROM ' . self::$tableName . ' WHERE id=:id LIMIT 1';
        return $this->removeItem($sql, $id);
    }
}
