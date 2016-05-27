<?php
/**
 * Phossa Project
 *
 * PHP version 5.4
 *
 * @category  Library
 * @package   Phossa\Orm
 * @copyright 2016 phossa.com
 * @license   http://mit-license.org/ MIT License
 * @link      http://www.phossa.com/
 */
/*# declare(strict_types=1); */

namespace Phossa\Orm\Model;

use Phossa\Orm\Utility\Utility;
use Phossa\Orm\Message\Message;
use Phossa\Orm\Exception\NotFoundException;

/**
 * Implemetation of ModelTableInterface methods
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     ModelTableInterface
 * @version 1.0.0
 * @since   1.0.0 added
 */
trait ModelTableTrait
{
    /**
     * Model name suffix if any, to be removed from table name
     *
     * @var    string
     * @access protected
     * @staticvar
     */
    protected static $model_name_suffix = 'Model';

    /**
     * table name case
     *
     * @var    int
     * @access protected
     * @staticvar
     */
    protected static $table_name_case = Utility::CASE_SNAKE;

    /**
     * table name prefix if any
     *
     * @var    string
     * @access protected
     * @staticvar
     */
    protected static $table_name_prefix = 'tbl_';

    /**
     * table name
     *
     * @var    string|array
     * @access protected
     * @staticvar
     */
    protected static $table_name = [];

    /**
     * database for this model if multiple dbs used.
     *
     * @var    string
     * @access protected
     */
    protected static $database = '';

    /**
     * possible namespaces for resolving a model name to its class
     *
     * @var    string[]
     * @access protected
     * @staticvar
     */
    protected static $model_search_ns = [];

    /**
     * {@inheritDoc}
     */
    public static function getModelClass(
        /*# string */ $modelName
    )/*# : string */ {

        $search = static::$model_search_ns;

        // append calling model namespace
        $search[] = (new \ReflectionClass(get_called_class()))
            ->getNamespaceName();

        // search model class
        foreach ($search as $ns) {
            $class = $ns . '\\' . $modelName .
                (static::$model_name_suffix ?: '');
            if (class_exists($class)) {
                return $class;
            }
        }

        throw new NotFoundException(
            Message::get(Message::ORM_MODEL_NOTFOUND, $modelName),
            Message::ORM_MODEL_NOTFOUND
        );
    }

    /**
     * {@inheritDoc}
     */
    public static function getModelName()/*# : string */
    {
        return Utility::removeSuffix(
            (new \ReflectionClass(get_called_class()))->getShortName(),
            static::$model_name_suffix
        );
    }

    /**
     * {@inheritDoc}
     */
    public static function getTableName()/*# : string */
    {
        // make sure current model booted
        static::boot();

        $class  = get_called_class();
        $parent = get_parent_class($class);

        // set by setTableName() or auto-generated already
        if (isset(self::$table_name[$class])) {
            $tbl = self::$table_name[$class];

        // set explicitly when extending class
        } elseif (is_string(static::$table_name)) {
            $tbl = static::$table_name;

        // table name auto-generation
        } else {
            $tbl = static::autoTableName();
            static::setTableName($tbl);
        }

        // return with dbname if any
        return (static::$database ? (static::$database . '.') : '') . $tbl;
    }

    /**
     * {@inheritDoc}
     */
    public static function setTableName(/*# string */ $tableName)
    {
        self::$table_name[get_called_class()] = $tableName;
    }

    /**
     * Auto generation of table name for this model
     *
     * @return string
     * @access protected
     * @static
     */
    protected static function autoTableName()/*# : string */
    {
        $class = get_called_class();

        // convert case of model name
        $name = Utility::convertCase(
            static::getModelName(), static::$table_name_case
        );

        // add table name prefix if any
        if (!empty(static::$table_name_prefix)) {
            $name = static::$table_name_prefix . $name;
        }

        return $name;
    }

    /*
     * from ModelBootTrait
     */
    abstract public static function boot();
}
