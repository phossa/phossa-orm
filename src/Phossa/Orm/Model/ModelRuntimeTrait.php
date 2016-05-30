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

use Phossa\Validate\ValidatorAwareTrait;
use Phossa\Event\Interfaces\EventAwareTrait;

/**
 * ModelRuntimeTrait
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
trait ModelRuntimeTrait
{
    use ModelRowTrait, ValidatorAwareTrait, EventAwareTrait, ExecutorTrait;

    /**
     * {@inheritDoc}
     */
    public function getEventsListening()/*# : array */
    {
        return [
            'beforeInsert'  => [],
            'afterInsert'   => [],
            'beforeDelete'  => [],
            'afterDelete'   => [],
            'beforeUpdate'  => [],
            'afterUpdate'   => [],
        ];
    }
}
