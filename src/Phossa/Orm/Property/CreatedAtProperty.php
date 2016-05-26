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
 * CreatedAtProperty
 *
 * IF you want to use an UNIXTIME column to keep creation time. Model will
 * insert current unixtime when create the row
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class CreatedAtProperty extends UnixtimeProperty
{
    /**
     * {@inheritDoc}
     */
    protected static $default_attributes = [
        // 'created_at' can be used as name
        'nameMust'      => false,

        // updateable
        'updateable'    => false,

        // callable
        'callable'      => [
            'beforeInsert'  => 'insertUnixTime',
        ],
    ];
}
