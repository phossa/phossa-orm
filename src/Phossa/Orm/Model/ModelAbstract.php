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
    use ModelRowTrait,
        ModelBootTrait,
        ModelTableTrait,
        ModelPropertyTrait,
        ValidatorAwareTrait;
}
