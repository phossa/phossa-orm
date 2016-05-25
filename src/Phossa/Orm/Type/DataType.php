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

namespace Phossa\Orm\Type;

/**
 * Common datatypes
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class DataType
{
    /**#@+
     * @var   string
     */

    const INTEGER       = 'INTEGER';
    const TINYINT       = 'TINYINT';
    const SMALLINT      = 'SMALLINT';
    const BIGINT        = 'BIGINT';

    const TIMESTAMP     = 'TIMESTAMP';

    const VARCHAR       = 'VARCHAR';
    const TEXT          = 'TEXT';
    const BINARY        = 'BINARY';

    // pseudo types
    const INDEX         = '__INDEX__';      // for table index
    const SHARE         = '__SHARE__';      // single table inheritance
    const RELATION      = '__RELATION__';

    /**#@-*/
}
