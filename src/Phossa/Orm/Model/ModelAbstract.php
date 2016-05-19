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
use Phossa\Db\Driver\DriverAwareTrait;
use Phossa\Db\Driver\DriverAwareInterface;
use Phossa\Query\Builder\BuilderInterface;
use Phossa\Query\Statement\BuilderAwareTrait;
use Phossa\Query\Statement\BuilderAwareInterface;

/**
 * ModelAbstract
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
abstract class ModelAbstract implements ModelInterface, BuilderAwareInterface, DriverAwareInterface
{
    use ColumnTrait, TableTrait, GetterTrait, DriverAwareTrait;
    use BuilderAwareTrait {
        setBuilder as setQueryBuilder;
    }

    /**
     * Constructor
     *
     * @param  DriverInterface $driver db driver
     * @param  BuilderInterface $builder query builder
     * @access public
     */
    public function __construct(
        DriverInterface $driver,
        BuilderInterface $builder
    ) {
        $this->setDriver($driver)
             ->setBuilder($builder);
    }

    /**
     * Set query builder, also set executor for the builder
     *
     * {@inheritDoc}
     */
    public function setBuilder(BuilderInterface $builder)
    {
        $this->setQueryBuilder($builder);
        return $this;
    }
}
