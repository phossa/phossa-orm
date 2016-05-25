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

use Phossa\Orm\Property\PropertyInterface;
use Phossa\Orm\Exception\NotFoundException;

/**
 * ModelPropertyInterface
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
interface ModelPropertyInterface
{
    /**
     * Get all properties for current model
     *
     * @return array
     * @access public
     * @static
     */
    public static function getProperties()/*# : array */;

    /**
     * Get the specific property object
     *
     * @param  string $propertyName
     * @return PropertyInterface
     * @throws NotFoundException if property not found
     * @access public
     */
    public static function getProperty(
        /*# string */ $propertyName
    )/*# : PropertyInterface */;

    /**
     * Get current model's mapping of propertyName => false|[tableName, colName],
     *
     * Underneath columns may exist in different tables !!
     *
     * @return array
     * @access public
     */
    public static function getColumns()/*# : array */;

    /**
     * Extended by siblings to define properties
     *
     * property definitions: [ propertyName => true|property_defintion, ... ]
     * property_definition : [
     *     'property' => '...', // propertyname without 'Property', such as 'BigId' etc.
     *     'propertyClass' => '...', // fully qualified class name
     *     'default'    => ...,   // property attributes
     *     ...
     * ]
     *
     * e.g.
     * ```php
     * public static function definedProperties()
     * {
     *     return [
     *         // enable generic 'idProperty'
     *         'id'  => true
     *
     *         // 'OptionsProperty' with different name 'opt'
     *         'opt' => [ 'property' => 'Options', 'default' => 1 ],
     *
     *         // foreign key
     *         'user_id' => [
     *             'foreignKey' => [ 'model' => 'User', 'property' => 'id' ]
     *         ],
     *     ];
     * }
     * ```
     * @return array
     * @access protected
     * @static
     */
    protected static function definedProperties()/*# : array */;
}
