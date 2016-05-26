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
 * ForeignKeyProperty
 *
 * Use this class if you need to define a foreign key constraint
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class ForeignKeyProperty extends ConstraintProperty
{
    /**
     * {@inheritDoc}
     */
    protected static $default_attributes = [
        // override this
        'foreignKey' => true,

        // has a column !!
        'columnName' => true,
    ];
}
