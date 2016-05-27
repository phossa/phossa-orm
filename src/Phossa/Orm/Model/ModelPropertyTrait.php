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
     * @access private
     * @staticvar
     */
    private static $properties = [];

    /**
     * {@inheritDoc}
     */
    public static function getProperties()/*# : array */
    {
        $class = get_called_class();

        // process the properties
        if (!isset(self::$properties[$class])) {
            self::$properties[$class] = static::processProperties();
        }

        return self::$properties[$class];
    }

    /**
     * {@inheritDoc}
     */
    public static function hasProperty(
        /*# string */ $propertyName
    )/*# : bool */ {
        return isset(static::getProperties()[$propertyName]);
    }

    /**
     * {@inheritDoc}
     */
    public static function getProperty(
        /*# string */ $propertyName
    )/*# : PropertyInterface */ {
        if (static::hasProperty($propertyName)) {
            return static::getProperties()[$propertyName];
        } else {
            throw new NotFoundException(
                Message::get(Message::ORM_PROP_NOTFOUND, $propertyName),
                Message::ORM_PROP_NOTFOUND
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    public static function getPrimaryProperty()
    {
        $properties = static::getProperties();

        /* @var $prop PropertyInterface */
        foreach ($properties as $name => $prop) {
            if ($prop->isPrimary()) {
                return $prop;
            }
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public static function getColumns()/*# : array */
    {
        $result = [];
        $properties = static::getProperties();

        /* @var $prop PropertyInterface */
        foreach ($properties as $name => $prop) {
            if ($prop->hasColumn()) {
                $result[$prop->getColumnName()] = $prop;
            }
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
