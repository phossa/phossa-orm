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
 * ConstraintInterface
 *
 * Table constraint (foreign key, index etc.)
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
interface ConstraintInterface
{
    /**
     * @return bool
     * @access public
     */
    public function isIndex()/*# : bool */;

    /**
     * @return bool
     * @access public
     */
    public function isBehavior()/*# : bool */;
}
