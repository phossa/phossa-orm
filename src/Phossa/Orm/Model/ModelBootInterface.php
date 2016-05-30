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

use Phossa\Db\Driver\DriverInterface;
use Phossa\Orm\Exception\RuntimeException;
use Phossa\Orm\Exception\NotFoundException;
use Phossa\Event\Interfaces\EventAwareStaticInterface;
use Phossa\Event\Interfaces\EventListenerStaticInterface;
use Phossa\Query\Builder\BuilderInterface;
use Phossa\Validate\ValidateInterface;

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
     * Prepare this model
     *
     * @throws RuntimeException invalid callable found
     * @access public
     * @static
     */
    public static function boot();

    /**
     * Set db driver statically
     *
     * @param  DriverInterface $db
     * @access public
     */
    public static function initDriver(DriverInterface $db);

    /**
     * get db driver
     *
     * @return DriverInterface
     * @throws NotFoundException driver not found
     * @access public
     */
    public static function getInitDriver()/*# : DriverInterface */;

    /**
     * set query builder statically
     *
     * @param  BuilderInterface $builder
     * @access public
     */
    public static function initQueryBuilder(BuilderInterface $builder);

    /**
     * get query builder
     *
     * @return BuilderInterface
     * @throws NotFoundException query builder not found
     * @access public
     */
    public static function getInitQueryBuilder()/*# : BuilderInterface */;

    /**
     * set validator
     *
     * @param  ValidateInterface $validator
     * @access public
     */
    public static function initValidator(ValidateInterface $validator);

    /**
     * get validator
     *
     * @return ValidateInterface
     * @throws NotFoundException validator not found
     * @access public
     */
    public static function getInitValidator()/*# : ValidateInterface */;
}
