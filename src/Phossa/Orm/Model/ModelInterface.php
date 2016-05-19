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
 * ModelInterface
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
interface ModelInterface
{
    /**
     * table/column name scheme
     *
     * @var    int
     */
    const NAME_SAME  = 1;   // same as model/property etc.
    const NAME_CAMEL = 2;   // camelCase
    const NAME_SNAKE = 4;   // snake_type

    /**
     * model relations
     *
     * @var    int
     */
    const RELATION_BELONGS_TO = 1;   // one to one
    const RELATION_ONE_MANY   = 2;   // one to many
    const RELATION_MANY_MANY  = 3;   // many to many

    /**
     * Get table name for this model
     *
     * @return string
     * @access public
     * @static
     */
    public static function getTableName()/*# : string */;

    /**
     * Get all column definitions
     *
     * @return array
     * @access public
     * @static
     */
    public static function &getColumns()/*# : array */;

    /**
     * Get column definition info
     *
     * @param  string $column
     * @return array
     * @throws NotFoundException if column not found
     * @access public
     * @static
     */
    public static function &getColumnInfo(/*# string */ $column)/*# : array */;

    /**
     * Get column name in the table
     *
     * @param  string $column
     * @return string
     * @throws NotFoundException if column not found
     * @access public
     * @static
     */
    public static function getColumnName(/*# string */ $column)/*# : string */;

    /**
     * Get the primary column (not column name in the table)
     *
     * @return string|null
     * @access public
     * @static
     */
    public static function getPrimaryColumn()/*# : string */;

    /**
     * Create table base on tableDefinition() & columnsDefinition()
     *
     * @param  bool $force force, drop first if exists
     * @access public
     */
    public function createTable(/*# bool */ $force = false);
}
