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

use Phossa\Shared\Arrayable\ArrayableInterface;

/**
 * ModelRowInterface
 *
 * Data row oriented methods (save row, delete row etc.)
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
interface ModelRowInterface extends ArrayableInterface
{
    /**
     * Save/update current data to the underneath table
     *
     * @return bool
     * @access public
     */
    public function save();

    /**
     * Delete current data from the underneath table
     *
     * @return bool
     * @access public
     */
    public function delete();

    /**
     * setter
     *
     * @param  string $name
     * @param  mixed $value
     * @access public
     */
    public function __set(/*# string */ $name, $value);

    /**
     * getter
     *
     * @param  string $name
     * @return mixed|null
     * @access public
     */
    public function __get(/*# string */ $name);

    /**
     * issetter
     *
     * @param  string $name
     * @return bool
     * @access public
     */
    public function __isset(/*# string */ $name)/*# : bool */;

    /**
     * unsetter
     *
     * @param  string $name
     * @access public
     */
    public function __unset(/*# string */ $name);
}
