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

namespace Phossa\Orm\Utility;

use Phossa\Shared\Pattern\StaticAbstract;

/**
 * Provides some utilities
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class Utility extends StaticAbstract
{
    /**
     * name case conversion
     *
     * @var    int
     */
    const CASE_SAME   = 1;  // no conversion
    const CASE_PASCAL = 2;  // PascalCase
    const CASE_CAMEL  = 3;  // camelCase
    const CASE_SNAKE  = 4;  // snake_case

    /**
     * Convert case of a string, property/column, model/table name etc.
     *
     * @param  string $string
     * @param  int $toCase
     * @return string
     * @access public
     * @static
     */
    public static function convertCase(
        /*# string */ $string,
        /*# int */ $toCase
    )/*# string */ {
        // no conversion
        if (self::CASE_SAME === $toCase) {
            return $string;
        }

        // break into lower case words
        $str = strtolower(ltrim(
            preg_replace(['/[A-Z]/', '/[_]/'], [' $0', ' '], $string)
        ));

        switch ($toCase) {
            case self::CASE_PASCAL:
            case self::CASE_CAMEL :
                $str = str_replace(' ', '', ucwords($str));
                return self::CASE_PASCAL == $toCase ? $str : lcfirst($str);
            case self::CASE_SNAKE :
                return str_replace(' ', '_', $str);
        }
    }

    /**
     * Remove a suffix (no matter the case) from a string
     *
     * @param  string $string
     * @param  string $suffix
     * @return string
     * @access public
     * @static
     */
    public static function removeSuffix(
        /*# string */ $string,
        /*# string */ $suffix
    )/*# string */ {
        $len = strlen($suffix);
        if ($len && substr($string, - $len) === $suffix) {
            return substr($string, - $len);
        }
        return $string;
    }
}
