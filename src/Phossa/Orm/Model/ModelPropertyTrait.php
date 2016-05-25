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
use Phossa\Orm\Utility\Utility;
use Phossa\Orm\Property\PropertyInterface;
use Phossa\Orm\Exception\NotFoundException;

/**
 * ModelPropertyTrait
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     ModelPropertyInterface
 * @version 1.0.0
 * @since   1.0.0 added
 */
trait ModelPropertyTrait
{
    /**
     * column name case, default to same as property name
     *
     * @var    int
     * @access protected
     * @staticvar
     */
    protected static $column_name_case = Utility::CASE_SAME;

    /**
     * column name prefix if any
     *
     * @var    string
     * @access protected
     * @staticvar
     */
    protected static $column_name_prefix = '';

    /**
     * properties cache
     *
     * @var    array
     * @access protected
     * @staticvar
     */
    protected static $properties  = [];

    /**
     * property to column mapping cache
     *
     * @var    array
     * @access protected
     * @staticvar
     */
    protected static $columns = [];

    /**
     * {@inheritDoc}
     */
    public static function getProperties()/*# : array */
    {
        $class = get_called_class();

        // process the properties
        if (!isset(static::$properties[$class])) {
            static::$properties[$class] = static::generateProperties();
        }

        return static::$properties[$class];
    }

    /**
     * {@inheritDoc}
     */
    public static function getProperty(
        /*# string */ $propertyName
    )/*# : PropertyInterface */ {
        $properties = $this->getProperties();
        if (!isset($properties[$propertyName])) {
            throw new NotFoundException(
                Message::get(Message::ORM_PROP_NOTFOUND, $propertyName),
                Message::ORM_PROP_NOTFOUND
                );
        }
        return $properties[$propertyName];
    }

    /**
     * {@inheritDoc}
     */
    public static function getColumns()/*# : array */
    {
        $class = get_called_class();

        // process the property to column mapping
        if (!isset(static::$columns[$class])) {
            static::$columns[$class] = static::processColumns();
        }

        return static::$columns[$class];
    }

    /**
     * Get/autogenerate column names for the properties
     *
     * @return array
     * @access protected
     */
    protected static function processColumns()/*# : array */
    {
        $properties = static::getProperties();
        $result = [];

        /* @var $fld PropertyInterface */
        foreach ($properties as $fld) {
            $name = $fld->getName();
            $col  = $fld->getColumnName();

            // no underneath column allowed
            if (false === $col) {
                continue;
            }

            // auto generate col name
            if (true === $col) {
                $col = static::autoColumnName($name);
                $fld->setColumnName($col);
            }

            $result[$name] = $col;
        }
        return $result;
    }

    /**
     * Generate column base on $propertyName and settings
     *
     * @param  string $propertyName
     * @return string
     * @access protected
     * @static
     */
    protected static function autoColumnName(
        /*# string */ $propertyName
    )/*# : string */ {
        // apply naming conversion
        $name = Utility::convertCase($propertyName, static::$column_name_case);

        // add prefix if any
        if (!empty(static::$column_name_prefix)) {
            $name = static::$column_name_prefix . $name;
        }
        return $name;
    }
}
