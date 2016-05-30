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
use Phossa\Db\Driver\DriverInterface;
use Phossa\Validate\ValidateInterface;
use Phossa\Orm\Exception\RuntimeException;
use Phossa\Query\Builder\BuilderInterface;
use Phossa\Orm\Exception\NotFoundException;
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
     * db driver
     *
     * @var    DriverInterface
     * @access protected
     * @staticvar
     */
    protected static $s_dbdriver;

    /**
     * query builder
     *
     * @var    BuilderInterface
     * @access protected
     * @staticvar
     */
    protected static $s_query_builder;

    /**
     * validator
     *
     * @var    ValidateInterface
     * @access protected
     * @staticvar
     */
    protected static $s_validator;

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
        $class = get_called_class();
        if (isset(self::$boot_status[$class])) {
            return;
        }

        // trigger 'boot' event
        $evtManager = (new EventManager())->attachListener($class);
        static::setEventManagerStatically($evtManager);
        static::triggerEventStatically('boot');

        // mark as booted
        self::$boot_status[$class] = true;
    }

    /**
     * {@inheritDoc}
     */
    public static function initDriver(DriverInterface $db)
    {
        static::$s_dbdriver = $db;
    }

    /**
     * {@inheritDoc}
     */
    public static function getInitDriver()/*# : DriverInterface */
    {
        if (is_null(static::$s_dbdriver)) {
            throw new NotFoundException(
                Message::get(Message::ORM_DB_NOTFOUND),
                Message::ORM_DB_NOTFOUND
            );
        }
        return static::$s_dbdriver;
    }

    /**
     * {@inheritDoc}
     */
    public static function initQueryBuilder(BuilderInterface $builder)
    {
        static::$s_query_builder = $builder;
    }

    /**
     * {@inheritDoc}
     */
    public static function getInitQueryBuilder()/*# : BuilderInterface */
    {
        if (is_null(static::$s_query_builder)) {
            throw new NotFoundException(
                Message::get(Message::ORM_BUILDER_NOTFOUND),
                Message::ORM_BUILDER_NOTFOUND
            );
        }
        return static::$s_query_builder;
    }

    /**
     * {@inheritDoc}
     */
    public static function initValidator(ValidateInterface $validator)
    {
        static::$s_validator = $validator;
    }

    /**
     * {@inheritDoc}
     */
    public static function getInitValidator()/*# : ValidateInterface */
    {
        if (is_null(static::$s_validator)) {
            throw new NotFoundException(
                Message::get(Message::ORM_VALIDATE_NOTFOUND),
                Message::ORM_VALIDATE_NOTFOUND
                );
        }
        return static::$s_validator;
    }

    /**
     * from EventListenerStaticInterface
     *
     * e.g.
     * ```php
     * public static function getEventsListeningStatically()
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
    public static function getEventsListeningStatically()/*# : array */
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
     * @param  int $priority  queue priority
     * @return array [callable, priority]
     * @throws RuntimeException if not valid callable found
     * @access public
     * @static
     */
    protected static function resolveCallable(
        /*# string */ $name,
        $callable,
        /*# int */ $priority = 50
    )/*# : callable */ {
        $class = get_called_class();
        if (is_callable($callable)) {
            return [$callable, $priority];

        } elseif (is_array($callable)) {
            return static::resolveCallable($name, $callable[0], $callable[1]);

        } elseif (is_string($callable) && method_exists($class, $callable)) {
            return [[$class, $callable], $priority];

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
    abstract protected static function getStaticVar($varName)/*# : array */;
}
