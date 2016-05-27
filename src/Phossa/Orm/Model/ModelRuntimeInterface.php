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

use Phossa\Validate\ValidatorAwareInterface;
use Phossa\Event\Interfaces\EventAwareInterface;
use Phossa\Event\Interfaces\EventListenerInterface;

/**
 * ModelRuntimeInterface
 *
 * Model object related methods.
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
interface ModelRuntimeInterface extends ModelRowInterface, ValidatorAwareInterface, EventAwareInterface, EventListenerInterface
{
}
