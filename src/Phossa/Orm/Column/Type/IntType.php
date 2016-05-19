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

namespace Phossa\Orm\Column\Type;

use Phossa\Orm\Column\Column;

/**
 * INT
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     Column
 * @version 1.0.0
 * @since   1.0.0 added
 */
class IntType extends Column
{
    /**
     * {@inheritDoc}
     */
    protected static $column_settings = [
        // data type
        'dataType'      => DataType::INT,

        // zero fill, boolean
        'zeroFill'      => false,

        // unsigned ?
        'unsigned'      => false,

        // column length, int
        'length'        => 11,

        // default value, string
        'default'       => '0',
    ];
}
