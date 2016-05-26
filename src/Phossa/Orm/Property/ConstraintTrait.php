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
 * ConstraintTrait
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     ConstraintInterface
 * @version 1.0.0
 * @since   1.0.0 added
 */
trait ConstraintTrait
{
    /**
     * it is a index property
     *
     * @var    bool
     * @access protected
     */
    protected $index = false;

    /**
     * it is a behavior property
     *
     * @var    bool
     * @access protected
     */
    protected $behavior = false;

    /**
     * @return bool
     * @access public
     */
    public function isIndex()/*# : bool */
    {
        return $this->index;
    }

    /**
     * @return bool
     * @access public
     */
    public function isBehavior()/*# : bool */
    {
        return $this->behavior;
    }
}
