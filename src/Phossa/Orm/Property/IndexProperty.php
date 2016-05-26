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

namespace Phossa\Orm\Property;

/**
 * IndexProperty
 *
 * Use this class if you need to define a primary key constraint with
 * multiple columns !!!
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class IndexProperty extends ConstraintProperty
{
    /**
     * it is a index property
     *
     * @var    bool
     * @access protected
     */
    protected $index = true;

    /**
     * {@inheritDoc}
     */
    protected static $default_attributes = [
        // not a column
        'columnName' => false,

        // other properties used in this primary key
        'properties' => [],
    ];
}
