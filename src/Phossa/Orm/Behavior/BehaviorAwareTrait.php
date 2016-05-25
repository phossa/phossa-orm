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

namespace Phossa\Orm\Behavior;

/**
 * BehaviorAwareTrait
 *
 * Behavior aware for a Model.
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     BehaviorAwareInterface
 * @version 1.0.0
 * @since   1.0.0 added
 */
trait BehaviorAwareTrait
{
    /**
     * behavior table sitting in the same DB of the model
     *
     * @var    string
     * @access protected
     * @staticvar
     */
    protected static $behavior_table = 'tbl_orm_behavior';
}
