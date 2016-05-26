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
 * UnixtimeProperty
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class UnixtimeProperty extends PropertyAbstract
{
    /**
     * {@inheritDoc}
     */
    protected static $default_attributes = [
        'dataType'  => DataType::UNIXTIME,
        'default'       => 0,
    ];

    /**
     * update value
     *
     * @param  array &$data
     * @access public
     */
    public function insertUnixTime(array &$data)
    {
        $data[$this->getName()] = time();
    }
}