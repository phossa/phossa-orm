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

use Phossa\Orm\Exception\NotFoundException;
use Phossa\Orm\Exception\LogicException;

/**
 * Model's table related methods
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
interface ModelTableInterface
{
    /**
     * Return the model class name base on the given modelName
     *
     * Child classes may override this method to suit their own needs.
     *
     * @param  string $modelName
     * @return string
     * @throws NotFoundException if model class not found
     * @access public
     * @static
     */
    public static function getModelClass(
        /*# string */ $modelName
    )/*# : string */;

    /**
     * Get model name (without 'Model' prefix) for current class
     *
     * @return string
     * @access public
     * @static
     */
    public static function getModelName()/*# : string */;

    /**
     * Get the underneath table name for current model.
     *
     * Normally table name is built from table name prefix and model name.
     *
     * @return string
     * @access public
     * @throws LogicException if invalid table name found
     * @static
     */
    public static function getTableName()/*# : string */;

    /**
     * Set the table name for this model explicitly
     *
     * @param  string $tableName
     * @access public
     * @static
     */
    public static function setTableName(/*# string */ $tableName);
}
