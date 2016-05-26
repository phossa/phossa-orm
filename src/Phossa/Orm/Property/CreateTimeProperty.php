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
 * CreatedTimeProperty
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class CreatedTimeProperty extends TimestampProperty
{
    /**
     * {@inheritDoc}
     */
    protected static $default_attributes = [
        // 'created_time' can be used as name
        'nameMust'      => false,

        // default
        'defaultRaw'    => 'CURRENT_TIMESTAMP',

        // updateable
        'updateable'    => false,
    ];
}
