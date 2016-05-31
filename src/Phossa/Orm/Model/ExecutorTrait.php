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
use Phossa\Db\Driver\DriverInterface;
use Phossa\Validate\ValidateInterface;
use Phossa\Db\Driver\DriverAwareTrait;
use Phossa\Validate\ValidatorAwareTrait;
use Phossa\Query\Builder\BuilderInterface;
use Phossa\Event\Interfaces\EventAwareTrait;
use Phossa\Query\Statement\BuilderAwareTrait;

/**
 * ExecutorTrait
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     ExecutorInterface
 * @version 1.0.0
 * @since   1.0.0 added
 */
trait ExecutorTrait
{
    use ModelBootTrait, DriverAwareTrait, BuilderAwareTrait, ValidatorAwareTrait, EventAwareTrait;

    /**
     * Override `getDriver()` from DriverAwareTrait.
     *
     * Late loading of db driver
     *
     * {@inheritDoc}
     */
    public function getDriver()/*# : DriverInterface */
    {
        if (null === $this->driver) {
            $this->driver = static::getInitDriver();
        }
        return $this->driver;
    }

    /**
     * Override `getBuilder()` from BuilderAwareTrait
     *
     * {@inheritDoc}
     */
    public function getBuilder()/*# : BuilderInterface */
    {
        if (null === $this->builder) {
            $this->builder = static::getInitQueryBuilder();
        }
        return $this->builder;
    }

    /**
     * Override `getValidator()` from ValidatorAwareTrait
     *
     * {@inheritDoc}
     */
    public function getValidator()/*# : ValidateInterface */
    {
        if (null === $this->validator) {
            $this->validator = static::getInitValidator();
        }
        return $this->validator;
    }

    /**
     * Override `getEventManager()` from EventAwareTrait
     * {@inheritDoc}
     */
    public function getEventManager()/*# : EventManagerInterface */
    {
        if (null === $this->event_manager) {
            $evtManager = new EventManager();
            $this->event_manager = $evtManager->attachListener($this);
        }
        return $this->event_manager;
    }
}
