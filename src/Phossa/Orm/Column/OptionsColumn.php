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

use Phossa\Orm\Column\Type\IntType;

/**
 * options, used to store status bits etc.
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     IntType
 * @version 1.0.0
 * @since   1.0.0 added
 */
class OptionsColumn extends IntType
{
    /**
     * {@inheritDoc}
     */
    protected static $column_settings = [
        'unsigned' => true,
    ];
}
