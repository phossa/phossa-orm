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

namespace Phossa\Orm\Column;

use Phossa\Orm\Column\Type\TimestampType;

/**
 * deleted_at column
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     TimestampType
 * @version 1.0.0
 * @since   1.0.0 added
 */
class DeletedAtColumn extends TimestampType
{
    /**
     * {@inheritDoc}
     */
    protected static $column_settings = [
        // nullable
        'notNull' => false,
    ];
}
