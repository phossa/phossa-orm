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

namespace Phossa\Orm\Model;

/**
 * ModelRowTrait
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     ModelRowInterface
 * @version 1.0.0
 * @since   1.0.0 added
 */
trait ModelRowTrait
{
    /**
     * row data from table
     *
     * @var    array
     * @access protected
     */
    protected $row_data = [];

    /**
     * {@inheritDoc}
     */
    public function __set(/*# string */ $name, $value)
    {
        $this->row_data[$name] = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function __get(/*# string */ $name)
    {
        if (array_key_exists($name, $this->row_data)) {
            return $this->row_data[$name];
        }
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function __isset(/*# string */ $name)
    {
        return isset($this->row_data[$name]);
    }

    /**
     * {@inheritDoc}
     */
    public function __unset(/*# string */ $name)
    {
        unset($this->row_data[$name]);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()/*# : array */
    {
        return $this->row_data;
    }

    /**
     * {@inheritDoc}
     */
    public function fromArray(array $data)
    {
        $this->row_data = $data;
        return $this;
    }
}
