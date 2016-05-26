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
 * ConstraintProperty
 *
 * Use this class if you need a table constraint like primary key, foreign
 * key, index etc.
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class ConstraintProperty extends PropertyAbstract implements ConstraintInterface
{
    use ConstraintTrait;

    /**
     * {@inheritDoc}
     */
    protected static $default_attributes = [
        // property type
        'propertyType' => PropertyInterface::TYPE_CONSTRAINT,

        // not a column
        'columnName' => false,
    ];
}
