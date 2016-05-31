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
use Phossa\Validate\ValidateInterface;
use Phossa\Query\Builder\BuilderInterface;

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
        // set db driver if any
        if (!is_null($driver)) {
            $this->setDriver($driver);
        }

        // set query builder if any
        if (!is_null($builder)) {
            $this->setBuilder($builder);
        }

        // set validator if any
        if (!is_null($validator)) {
            $this->setValidator($validator);
        }
    }
}
