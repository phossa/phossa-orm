<?php
/**
 * Phossa Project
 *
 * PHP version 5.4
 *
 * @category  Library
 * @package   Phossa\Orm
 * @copyright 2015 phossa.com
 * @license   http://mit-license.org/ MIT License
 * @link      http://www.phossa.com/
 */
/*# declare(strict_types=1); */

namespace Phossa\Orm\Exception;

use Phossa\Shared\Exception\NotFoundException as NFException;

/**
 * NotFoundException for \Phossa\Orm
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     ExceptionInterface
 * @see     \Phossa\Shared\Exception\NotFoundException
 * @version 1.0.0
 * @since   1.0.0 added
 */
class NotFoundException extends NFException implements ExceptionInterface
{
}
