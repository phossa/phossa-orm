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

use Phossa\Orm\Exception\RuntimeException;
use Phossa\Event\Interfaces\EventAwareStaticInterface;
use Phossa\Event\Interfaces\EventListenerStaticInterface;

/**
 * ModelBootInterface
 *
 * Prepare model to be used
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
interface ModelBootInterface extends EventAwareStaticInterface, EventListenerStaticInterface
{
    /**
     * Prepare this model, returns booted settings in array
     *
     * @return array
     * @throws RuntimeException invalid callable found
     * @access public
     * @static
     */
    public static function boot(

    )/*# : array */;

    /**
     * Is this model booted ?
     *
     * @return bool
     * @access public
     * @staticvar
     */
    public static function isBooted()/*# : bool */;
}
