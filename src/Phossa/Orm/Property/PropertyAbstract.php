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

use Phossa\Orm\Utility\Utility;
use Phossa\Orm\Message\Message;
use Phossa\Orm\Utility\StaticVarTrait;
use Phossa\Orm\Exception\LogicException;

/**
 * PropertyAbstract
 *
 * @abstract
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
abstract class PropertyAbstract implements PropertyInterface
{
    use StaticVarTrait;

    /**
     * property attributes
     *
     * @var    array
     * @access protected
     * @staticvar
     */
    protected static $default_attributes = [
        // property type
        'propertyType'  => PropertyInterface::TYPE_COLUMN,

        // must provide a new name
        'nameMust'      => true,

        // underneath column allowed, FALSE to disable
        'columnName'    => true,

        // autoincrement, boolean
        'autoIncrement' => false,

        // is primary key, boolean
        'primaryKey'    => false,

        // is foreign key, false|array
        'foreignKey'    => false,

        // not null ?, boolean
        'notNull'       => true,

        // default value
        'default'       => false,

        // raw version of default value
        'defaultRaw'    => false,

        // other constraints for this column, string
        'constraint'    => [],

        // callable. e.g. ['beforeSave' => 'serialize']
        'callable'      => [],

        // validate ruleset or callable
        'validate'      => [],

        // insertable
        'insertable'    => true,

        // updateable
        'updateable'    => true,
    ];

    /**
     * Property name suffix to remove
     *
     * @var    string
     * @access protected
     * @staticvar
     */
    protected static $property_name_suffix = 'Property';

    /**
     * attributes for $this
     *
     * @var    array
     * @access protected
     */
    protected $attributes;

    /**
     * Constructor
     *
     * @param  array $attributes
     * @throws LogicException if name required and not set
     * @access public
     */
    public function __construct(array $attributes = [])
    {
        $this->attributes = array_replace_recursive(
            static::getStaticVar('default_attributes'),
            $attributes
        );

        // check name
        $this->checkName();
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        // name is not preset or not generated yet
        if (!isset($this->attributes['name'])) {
            $this->attributes['name'] = Utility::removeSuffix(
                (new \ReflectionClass(get_called_class()))->getShortName(),
                static::$property_name_suffix
            );
        }
        return $this->attributes['name'];
    }

    /**
     * {@inheritDoc}
     */
    public function hasColumn()/*# : bool */
    {
        return false !== $this->attributes['columnName'];
    }

    /**
     * {@inheritDoc}
     */
    public function setColumnName(/*# string */ $colName)
    {
        if ($this->hasColumn()) {
            $this->attributes['columnName'] = $colName;
            return $this;
        }
        throw new LogicException(
            Message::get(Message::ORM_PROP_NOCOLUMN, $this->getName()),
            Message::ORM_PROP_NOCOLUMN
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getColumnName()
    {
        return $this->attributes['columnName'];
    }

    /**
     * {@inheritDoc}
     */
    public function isAutoIncrement()/*# : bool */
    {
        return (bool) $this->attributes['autoIncrement'];
    }

    /**
     * {@inheritDoc}
     */
    public function isPrimary()/*# : bool */
    {
        return (bool) $this->attributes['primaryKey'];
    }

    /**
     * {@inheritDoc}
     */
    public function isForeign()/*# : bool */
    {
        if (false === $this->attributes['foreignKey']) {
            return false;
        }
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function isConstraint()/*# : bool */
    {
        return $this->attributes['propertyType'] &
            PropertyInterface::TYPE_CONSTRAINT;
    }

    /**
     * {@inheritDoc}
     */
    public function isNullable()/*# : bool */
    {
        return !$this->attributes['notNull'];
    }

    /**
     * {@inheritDoc}
     */
    public function getConstraint()/*# : array */
    {
        return $this->attributes['constraint'];
    }

    /**
     * {@inheritDoc}
     */
    public function getCallable()/*# : array */
    {
        return $this->attributes['callable'];
    }

    /**
     * Name required ?
     *
     * @throws LogicException if name required
     * @access protected
     */
    protected function checkName()
    {
        if ($this->attributes['nameMust'] &&
            !isset($this->attributes['name'])
        ) {
            throw new LogicException(
                Message::get(Message::ORM_NAME_NOTFOUND),
                Message::ORM_NAME_NOTFOUND
            );
        }
    }
}
