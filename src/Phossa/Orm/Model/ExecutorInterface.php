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

use Phossa\Db\Driver\DriverAwareInterface;
use Phossa\Query\Statement\BuilderAwareInterface;
use Phossa\Query\Statement\ExecutorInterface as ExeInterface;

/**
 * ExecutorInterface
 *
 * Query executor
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     \Phossa\Query\Statement\ExecutorInterface
 * @version 1.0.0
 * @since   1.0.0 added
 */
interface ExecutorInterface extends ExeInterface, BuilderAwareInterface, DriverAwareInterface
{
}
