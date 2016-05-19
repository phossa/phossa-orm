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

trait GetterTrait
{
    /**
     * data storage
     *
     * @var    array
     * @access protected
     */
    protected $data = [];

    /**
     * setter
     *
     * @param  string $name
     * @param  mixed $value
     * @access public
     */
    public function __set(/*# string */ $name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * getter
     *
     * @param  string $name
     * @return mixed|null
     * @access public
     */
    public function __get(/*# string */ $name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return null;
    }

    /**
     * issetter
     *
     * @param  string $name
     * @return bool
     * @access public
     */
    public function __isset(/*# string */ $name)
    {
        return isset($this->data[$name]);
    }

    /**
     * unsetter
     *
     * @param  string $name
     * @access public
     */
    public function __unset(/*# string */ $name)
    {
        unset($this->data[$name]);
    }

    /**
     * batch getter
     *
     * @return array
     * @access public
     */
    public function toArray()/*# : array */
    {
        return $this->data;
    }

    /**
     * batch setter
     *
     * @param  array $data
     * @access public
     */
    public function fromArray(array $data)/*# : array */
    {
        $this->data = $data;
    }
}
