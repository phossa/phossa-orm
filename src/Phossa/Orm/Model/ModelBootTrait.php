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

use Phossa\Event\EventManager;
use Phossa\Orm\Message\Message;
use Phossa\Orm\Exception\RuntimeException;
use Phossa\Event\Interfaces\EventAwareStaticTrait;

/**
 * ModelBootTrait
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     ModelBootInterface
 * @version 1.0.0
 * @since   1.0.0 added
 */
trait ModelBootTrait
{
    use EventAwareStaticTrait;

    /**
     * boot status cache
     *
     * @var    array
     * @access prviate
     * @staticvar
     */
    private static $boot_status = [];

    /**
     * boot callables format:
     *
     * ```php
     * $boot_callable = [
     *     'uniqueName' => callable|function|[callable|function, priority]
     * ];
     * ```
     *
     * @var    array
     * @access protected
     * @staticvar
     */
    protected static $boot_callable = [];

    /**
     * {@inheritDoc}
     */
    public static function boot()
    {
        // booted already
        if (static::isBooted()) {
            return;
        }

        // trigger 'boot' event
        $evtManager = (new EventManager())->attachListener(get_called_class());
        static::setEventManagerStatically($evtManager);
        static::triggerEventStatically('boot');

        // mark as booted
        self::$boot_status[get_called_class()] = true;
    }

    /**
     * {@inheritDoc}
     */
    public static function isBooted()/*# : bool */
    {
        return isset(self::$boot_status[get_called_class()]);
    }

    /**
     * from EventListenerStaticInterface
     *
     * e.g.
     * ```php
     * public static function getEventsListening()
     * {
     *     return array(
     *         eventName1 => 'method1', // method1 of static class
     *         eventName2 => array('method2', 20), // priority 20
     *         eventName3 => array(
     *             [ 'method3', 70 ],
     *             [ 'method4', 50 ]
     *         )
     *     );
     * }
     * ```
     *
     * {@inheritDoc}
     */
    public static function getEventsListening()/*# : array */
    {
        // merge callables
        $callables = static::getStaticVar('boot_callable');

        $res = [];
        foreach ($callables as $name => $call) {
            // skip disabled callable
            if (false === $call) {
                continue;
            }

            // resolve callable
            $res[] = static::resolveCallable($name, $call);
        }

        // listen to 'boot' event
        return ['boot' => $res];
    }

    /**
     * resolve a callable
     *
     * @param  string $name unique name to mark this callable
     * @param  string|callable $callable
     * @return array [callable, priority]
     * @throws RuntimeException if not valid callable found
     * @access public
     */
    protected function resolveCallable(
        /*# string */ $name,
        $callable
    )/*# : callable */ {
        // default priority
        $prior = 50;

        $class = get_called_class();

        if (is_callable($callable)) {
            return [$callable, $prior];

        } elseif (is_array($callable)) {
            return [
                static::resolveCallable($name, $callable[0]),
                $callable[1]
            ];

        } elseif (is_string($callable) && method_exists($class, $callable)) {
            return [[$class, $callable], $prior];

        } else {
            throw new RuntimeException(
                Message::get(Message::ORM_INVALID_CALLABLE, $name),
                Message::ORM_INVALID_CALLABLE
            );
        }
    }

    /**
     * shared from Utility\StaticVarTrait
     */
    abstract protected function getStaticVar($varName)/*# : array */;
}
