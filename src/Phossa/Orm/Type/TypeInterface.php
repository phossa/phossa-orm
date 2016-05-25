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

namespace Phossa\Orm\Type;

/**
 * TypeInterface
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
interface TypeInterface
{
    /**
     * Get the property name, if not set, generate one
     *
     * Note: Property name may be different from the underneath column name
     *
     * @return string
     * @access public
     */
    public function getName();

    /**
     * Explicitly set the underneath column name
     *
     * @param  string $colName
     * @return self
     * @access public
     */
    public function setColumnName(/*# string */ $colName);

    /**
     * Get the underneatch column name
     *
     * @return bool|string
     * @access public
     */
    public function getColumnName();

    /**
     * Is this an auto increment property ?
     *
     * @return bool
     * @access public
     */
    public function isAutoIncrement()/*# : bool */;

    /**
     * Is this a primary key property ?
     *
     * @return bool
     * @access public
     */
    public function isPrimary()/*# : bool */;

    /**
     * Is this an unique key property ?
     *
     * @return bool
     * @access public
     */
    public function isUnique()/*# : bool */;

    /**
     * Is this a foreign key property ?
     *
     * @return bool
     * @access public
     */
    public function isForeign()/*# : bool */;

    /**
     * Is this a nullable column ?
     *
     * @return bool
     * @access public
     */
    public function isNullable()/*# : bool */;

    /**
     * other constraints for the underneath column
     *
     * @return string[]
     * @access public
     */
    public function getConstraint()/*# : array */;

    /**
     * callable for this property
     *
     * @return callable[]
     * @access public
     */
    public function getCallable()/*# : array */;
}
