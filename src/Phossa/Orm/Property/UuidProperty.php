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
 * UuidProperty
 *
 * Custom uuid property
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class UuidProperty extends BinaryProperty
{
    /**
     * {@inheritDoc}
     */
    protected static $default_attributes = [
        // 'uuid' can be used as name
        'nameMust'  => false,

        // data size
        'dataSize'  => 16,

        // unique
        'uniqueKey' => true,
    ];
}
