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

use Phossa\Orm\Type\IntType;

/**
 * 'id' is mostly used as primary key
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class IdProperty extends IntType implements PropertyInterface
{
    /**
     * {@inheritDoc}
     */
    protected static $default_attributes = [
        // 'id' can be used as name
        'nameMust'      => false,

        // UNSIGNED
        'unsigned'      => true,

        // auto increment
        'autoIncrement' => true,

        // primary key
        'primaryKey'    => true,

        // insertable
        'insertable'    => false,

        // updateable
        'updateable'    => false,
    ];
}
