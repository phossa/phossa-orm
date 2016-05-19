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

/**
 * Table related stuff
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
trait TableTrait
{
    /**
     * table name scheme
     *
     * @var    int
     * @access protected
     * @staticvar
     */
    protected static $table_name_scheme = ModelInterface::NAME_SNAKE;

    /**
     * table name prefix if any
     *
     * @var    string
     * @access protected
     * @staticvar
     */
    protected static $table_name_prefix = 'tbl_';

    /**
     * exact table name if defined
     *
     * @var    string
     * @access protected
     * @staticvar
     */
    protected static $table_name = [];

    /**
     * {@inheritDoc}
     */
    public static function getTableName()/*# : string */
    {
        $class = get_called_class();
        if (!isset(static::$table_name[$class])) {
            // apply naming scheme to model's name
            $name = static::convertName(
                (new \ReflectionClass(get_called_class()))->getShortName(),
                static::$table_name_scheme
            );

            // add prefix if any
            if (!empty(static::$table_name_prefix)) {
                $name = static::$table_name_prefix . $name;
            }
            static::$table_name[$class] = $name;
        }
        return static::$table_name[$class];
    }

    /**
     * {@inheritDoc}
     */
    public function createTable(/*# bool */ $force = false)
    {
        $tblName = static::getTableName();
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
    protected static function convertName(
        /*# string */ $name,
        /*# int */ $converType,
        /*# string */ $removeSuffix = 'model'
    )/*# : string */ {
        // remove 'model' if exist
        if (!empty($removeSuffix) && $removeSuffix ===
            strtolower(substr($name, 0 - strlen($removeSuffix)))
        ) {
            $name = substr($name, 0, -5);
        }

        if ($converType & ModelInterface::NAME_CAMEL) {
            return lcfirst($name);
        } elseif ($converType & ModelInterface::NAME_SNAKE) {
            return ltrim(
                strtolower(preg_replace('/[A-Z]/', '_$0', $name)),
                '_'
            );
        } else {
            return $name;
        }
    }
}
