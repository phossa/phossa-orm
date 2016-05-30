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
use Phossa\Query\Builder\BuilderInterface;
use Phossa\Validate\ValidateInterface;

/**
 * Base Model class
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     ModelInterface
 * @version 1.0.0
 * @since   1.0.0 added
 */
abstract class ModelAbstract implements ModelInterface
{
    use ModelFactoryTrait, ModelRuntimeTrait;

    /**
     * Construct the model
     *
     * @access public
     */
    public function __construct(
        DriverInterface $driver = null,
        BuilderInterface $builder = null,
        ValidateInterface $validator = null
    ) {
        // boot model
        static::boot();

        // set db driver
        $this->setDriver($driver ?: static::getInitDriver());

        // set query builder
        $qb = clone ($builder ?: static::getInitQueryBuilder());
        $this->setBuilder(
            $qb->table(static::getTableName(), 'tbl')
               ->setExecutor($this)
        );

        // set validator
        $this->setValidator($validator ?: static::getInitValidator());

        // init local event manager
        $evtManager = (new EventManager())->attachListener($this);
        $this->setEventManager($evtManager);
    }
}
