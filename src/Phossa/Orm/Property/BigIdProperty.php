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
 * BigIdProperty
 *
 * Use a BIGINT column as the primary key
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class BigIdProperty extends BigintProperty
{
    /**
     * {@inheritDoc}
     */
    protected static $default_attributes = [
        // suggest 'id' as property name
        'name'          => 'id',

        // 'id' can be used as name
        'nameMust'      => false,

        // UNSIGNED
        'unsigned'      => true,

        // auto increment
        'autoIncrement' => true,

        // primary key
        'primaryKey'    => true,

        // insertable
        'insertable'    => true,

        // updateable
        'updateable'    => false,
    ];
}
