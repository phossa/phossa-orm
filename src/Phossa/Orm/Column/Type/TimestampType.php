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
 * TIMESTAMP
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     Column
 * @version 1.0.0
 * @since   1.0.0 added
 */
class TimestampType extends Column
{
    /**
     * {@inheritDoc}
     */
    protected static $column_settings = [
        'dataType'   => DataType::TIMESTAMP,
        'defaultRaw' => 'CURRENT_TIMESTAMP',
    ];
}
