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
 * 'id' is mostly used as primary key
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class IdProperty extends IntegerProperty
{
    /**
     * {@inheritDoc}
     */
    protected static $default_attributes = [
        // 'id' will be used as column name if name not provided
        'nameMust'      => false,

        // primary key etc.
        'autoIncrement' => true,
        'primaryKey'    => true,
        'insertable'    => true,
        'updateable'    => false,
    ];
}
