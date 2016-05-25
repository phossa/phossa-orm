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
    /**
     * boot status cache
     *
     * @var    array
     * @access prviate
     * @staticvar
     */
    private static $boot_status = [];

    /**
     * boot callables
     *
     * @var    callable[]
     * @access protected
     * @staticvar
     */
    protected static $boot_callable = [
    ];

    /**
     * {@inheritDoc}
     */
    public static function boot()
    {
        $class = get_called_class();

        // booted already
        if (isset(self::$boot_status[$class])) {
            return;
        }

        // callables to boot
        $callables = static::getBootCallable();
        foreach ($callables as $callable) {
            call_user_func($callable);
        }

        // mark as booted
        self::$boot_status[$class] = true;
    }

    /**
     * Get callables from inheritance tree
     *
     * @return array
     * @access protected
     * @static
     */
    protected static function getBootCallable()/*# : array */
    {
        // merge callables
        $callables = static::getStaticVar('boot_callable');

        // expand as valid callable
        $class = get_called_class();
        $res = [];
        foreach ($callables as $name => $call) {
            if (is_callable($call)) {
                $res[$name] = $call;
            } elseif (is_string($call) && method_exists($class, $call)) {
                $res[$name] = [$class, $call];
            }
        }

        return $res;
    }

    /**
     * Merge/replace static variable (array) in a inheritance tree
     *
     * @param  string $varName
     * @return array
     * @access protected
     */
    abstract protected function getStaticVar($varName)/*# : array */;
}
