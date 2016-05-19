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

use Phossa\Orm\Message\Message;
use Phossa\Orm\Exception\NotFoundException;

/**
 * Column related stuff
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
trait ColumnTrait
{
    /**
     * column name scheme, default to same as definition name
     *
     * @var    int
     * @access protected
     * @staticvar
     */
    protected static $column_name_scheme = ModelInterface::NAME_SAME;

    /**
     * column name prefix if non empty
     *
     * @var    string
     * @access protected
     * @staticvar
     */
    protected static $column_name_prefix = '';

    /**
     * cached column definitions
     *
     * @var    array
     * @access protected
     * @staticvar
     */
    protected static $columns = [];

    /**
     * default attributes for a column
     *
     * @var    array
     * @access protected
     * @staticvar
     */
    protected static $default_attributes = [
        // column data type, string
        'dataType'      => DataType::INT,

        // zero fill, boolean
        'zeroFill'      => false,

        // unsigned ?
        'unsigned'      => false,

        // column length, int
        'length'        => 11,

        // null or not null, boolean
        'notNull'       => true,

        // default value, string
        'default'       => '0',

        // raw version of default value
        'defaultRaw'    => null,

        // is primary key, boolean
        'primaryKey'    => false,

        // is unique key, boolean
        'uniqueKey'     => false,

        // autoincrement, boolean
        'autoIncrement' => false,

        // visible in json output, boolean
        'visibility'    => true,

        // column order, int, 0 for default order
        'columnOrder'   => 0,

        // other constraint for this column, string
        'constraint'    => '',

        // before save, callable. e.g. 'serialize'
        'beforeSave'    => null,

        // after get, callable. e.g. 'unserialize'
        'afterGet'      => null,
    ];

    /**
     * default column definitions
     *
     * @var    array
     * @access protected
     * @staticvar
     */
    protected static $default_columns = [
        // used as primary key, usually INT or BIGINT
        'id' => [
            'dataType'      => DataType::INT,
            'primaryKey'    => true,
            'autoIncrement' => true,
        ],

        // uuid
        'uuid' => [
            'dataType'      => DataType::BINARY,
            'length'        => 16,
        ],

        // option bits indicating status or other options
        'options' => [
            'dataType' => DataType::INT,
            'unsigned' => true,
        ],

        // creation timestamp
        'created_at' => [
            'dataType'   => DataType::TIMESTAMP,
            'defaultRaw' => 'CURRENT_TIMESTAMP',
        ],

        // modification timestamp
        'modified_at' => [
            'dataType'   => DataType::TIMESTAMP,
            'defaultRaw' => 'CURRENT_TIMESTAMP',
            'constraint' => 'ON UPDATE CURRENT_TIMESTAMP',
        ],

        // generic settings normally no seperate column needed
        'settings'  => [
            'dataType'    => DataType::TEXT,
            'default'     => 'a:0:{}',
            'beforeSave'  => 'serialize',
            'afterGet'    => 'unserialize',
            'columnOrder' => 100, // put at the end
        ],
    ];

    /**
     * model specific column definitions
     *
     * @var    array
     * @access protected
     * @staticvar
     */
    protected static $model_columns = [
        /* example
        'article_count' => [
            'dataType'  => DataType::INT,
        ],
        */
    ];

    /**
     * Model relations
     *
     * @var    array
     * @access protected
     * @staticvar
     */
    protected static $relations = [
        /* examples,
        [
            'relationType' => ModelInterface::RELATION_BELONGS_TO_MANY,
            'modelName'    => 'Group',
            'targetColumn' => 'id',
            'through'      => 'UserGroup',
            'column'       => 'addr_id',
            'columnName'   => 'user_addr_id'
        ],
        */
    ];

    /**
     * {@inheritDoc}
     */
    public static function &getColumns()/*# : array */
    {
        $class = get_called_class();
        if (!isset(static::$columns[$class])) {
            // init
            static::$columns[$class] = [];
            $cols = &static::$columns[$class];

            // add default columns
            static::addColumns($cols, 'default_columns');

            // add association columns
            static::addColumns($cols, 'foreign_columns');

            // add model specific columns
            static::addColumns($cols, 'model_columns');

            // sort
        }
        return static::$columns[$class];
    }

    /**
     * {@inheritDoc}
     */
    public static function &getColumnInfo(/*# string */ $column)/*# : array */
    {
        $cols = &static::getColumns();
        if (!isset($cols[$column])) {
            throw new NotFoundException(
                Message::get(Message::ORM_COLUMN_NOTFOUND, $column),
                Message::ORM_COLUMN_NOTFOUND
            );
        }
        return $cols[$column];
    }

    /**
     * {@inheritDoc}
     */
    public static function getColumnName(/*# string */ $column)/*# : string */
    {
        $def = &static::getColumnInfo($column);

        if (!isset($def['columnName'])) {
            // apply naming scheme
            $name = static::convertName($column, static::$column_name_scheme);

            // add prefix if any
            if (!empty(static::$column_name_prefix)) {
                $name = static::$column_name_prefix . $name;
            }

            $def['columnName'] = $name;
        }

        return $def['columnName'];
    }

    /**
     * {@inheritDoc}
     */
    public static function getPrimaryColumn()/*# : string */
    {
        $cols = &static::getColumns();
        foreach ($cols as $col => $def) {
            if ($def['primaryKey']) return $col;
        }
        return null;
    }

    /**
     * Add default columns to the column definition pool
     *
     * @param  array &$columns
     * @param  string $type column type, 'default_columns' etc.
     * @access protected
     */
    protected static function addColumns(array &$columns, /*# string */ $type)
    {
        $attrs = static::getCurrentSettings('default_attributes');
        $cols  = static::getCurrentSettings($type);
        foreach ($cols as $col => $def) {
            if (is_array($def)) {
                $columns[$col] = array_replace_recursive($attrs, $def);
            }
        }
    }

    /**
     * Merge & replace to get current model settings
     *
     * @param  string $name
     * @return array
     * @access protected
     */
    protected static function getCurrentSettings(/*# string */ $name)
    {
        $result = static::${$name};
        if (self::${$name} !== static::${$name}) {
            // explicitly emptied
            if (empty(static::${$name})) {
                $result = [];

            // replace parent's settings
            } else {
                $pclass = get_parent_class(get_called_class());
                $result = array_replace_recursive(
                    $pclass::getCurrentSettings($name),
                    static::${$name}
                );
            }
        }
        return $result;
    }

    /**
     * convert name base type either camelCase, snake_type etc.
     *
     * @param  string $name
     * @param  int $converType
     * @param  string $removeSuffix remove 'model' suffix if any
     * @return string
     * @access protected
     * @static
     */
    abstract protected static function convertName(
        /*# string */ $name,
        /*# int */ $converType,
        /*# string */ $removeSuffix = 'model'
    )/*# : string */;
}
