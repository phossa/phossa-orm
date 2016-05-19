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

namespace Phossa\Orm\Relation;

use Phossa\Orm\Model\ModelAbstract;

/**
 * RelationModel
 *
 * Generic model for ONE_MANY or MANY_MANY relations. Normally contains
 * 2 columns for other 2 models.
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class RelationModel extends ModelAbstract
{
    /**
     * NO normal default columns
     *
     * {@inheritDoc}
     */
    protected static $default_columns = [];
}
