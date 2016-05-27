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
     * Guess the model class name base on the given modelName
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
     * Get model name (without 'Model' suffix) for calling model
     *
     * Base on current model class name, cut off the suffix if any
     *
     * @return string
     * @access public
     * @static
     */
    public static function getModelName()/*# : string */;

    /**
     * Get the underneath table name for calling model.
     *
     * Three methods to define the table name,
     *
     * - set explicitly with `setTableName()`
     *
     * - set class::$table_name = 'yourTableName' when extending model class
     *
     *   - be sure to reset to `NULL` if parent model class set this already
     *     and child don't want to use the same table.
     *
     * - set automatically by table name prefix and model name
     *
     * @return string
     * @access public
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
