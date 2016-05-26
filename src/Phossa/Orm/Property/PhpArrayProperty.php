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
 * PhpArrayProperty
 *
 * Custom column to store serialized php array
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class PhpArrayProperty extends PropertyAbstract
{
    /**
     * {@inheritDoc}
     */
    protected static $default_attributes = [
        // data type
        'dataType'  => DataType::PHP_ARRAY,

        // callable
        'callable'  => [
            'beforeSave' => 'serializeData',
            'afterGet'   => 'unserializeData',
        ],
    ];

    /**
     * serialize the php array
     *
     * @access public
     */
    public function serializeData()
    {
        $model = $this->getModel();
        $name  = $this->getName();
        $model->$name = serialize($model->$name);
    }

    /**
     * unserialize
     *
     * @access public
     */
    public function unserializeData()
    {
        $model = $this->getModel();
        $name  = $this->getName();
        $model->$name = unserialize($model->$name);
    }
}
