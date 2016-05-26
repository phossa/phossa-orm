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

use Phossa\Query\Dialect\DataType;

/**
 * BinaryProperty
 *
 * Use this class if you need a BINARY column. Must set 'dataSize'
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class BinaryProperty extends PropertyAbstract
{
    /**
     * {@inheritDoc}
     */
    protected static $default_attributes = [
        'dataType'  => DataType::BINARY,

        // user has to override this
        'dataSize'      => 0,
    ];
}
