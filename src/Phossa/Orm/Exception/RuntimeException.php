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

use Phossa\Shared\Exception\RuntimeException as RTException;

/**
 * RuntimeException for \Phossa\Orm
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     ExceptionInterface
 * @see     \Phossa\Shared\Exception\RuntimeException
 * @version 1.0.0
 * @since   1.0.0 added
 */
class RuntimeException extends RTException implements ExceptionInterface
{
}
