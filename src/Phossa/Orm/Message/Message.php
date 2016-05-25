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

    /*
     * Name is missing
     */
    const ORM_NAME_NOTFOUND     = 1605241053;

    /*
     * Model "%s" not found
     */
    const ORM_MODEL_NOTFOUND    = 1605241054;

    /*
     * Model "%s" shares parent table "%s"
     */
    const ORM_MODEL_SAMETABLE   = 1605241055;

    /*
     * Property "%s" does NOT allow column
     */
    const ORM_PROP_NOCOLUMN     = 1605241056;

    /*
     * Property "%s" not found
     */
    const ORM_PROP_NOTFOUND     = 1605241057;

    /**#@-*/

    /**
     * {@inheritdoc}
     */
    protected static $messages = [
        self::ORM_NAME_NOTFOUND     => 'Name is missing',
        self::ORM_MODEL_NOTFOUND    => 'Model "%s" not found',
        self::ORM_MODEL_SAMETABLE   => 'Model "%s" shares parent table "%s"',
        self::ORM_PROP_NOCOLUMN     => 'Property "%s" does NOT allow column',
        self::ORM_PROP_NOTFOUND     => 'Property "%s" not found',
    ];
}
