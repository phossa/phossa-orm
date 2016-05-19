<?php
/**
 * Phossa Project
 *
 * PHP version 5.4
 *
 * @category  Package
 * @package   Phossa\Orm
 * @author    Hong Zhang <phossa@126.com>
 * @copyright 2015 phossa.com
 * @license   http://mit-license.org/ MIT License
 * @link      http://www.phossa.com/
 */
/*# declare(strict_types=1); */

namespace Phossa\Orm\Message;

use Phossa\Shared\Message\MessageAbstract;

/**
 * Message class for Phossa\Orm
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     \Phossa\Shared\Message\MessageAbstract
 * @version 1.0.0
 * @since   1.0.0 added
 */
class Message extends MessageAbstract
{
    /**#@+
     * @var   int
     */

    /**
     * Orm column "%s" not found
     */
    const ORM_COLUMN_NOTFOUND   = 1605190933;

    /**#@-*/

    /**
     * {@inheritdoc}
     */
    protected static $messages = [
        self::ORM_COLUMN_NOTFOUND   => 'Orm column "%s" not found',
    ];
}
