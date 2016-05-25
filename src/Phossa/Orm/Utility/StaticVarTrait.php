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

/**
 * Dealing static vars and methods
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
trait StaticVarTrait
{
    /**
     * Merge/replace static variable (array) in a inheritance tree
     *
     * @param  string $varName
     * @return array
     * @access protected
     */
    protected function getStaticVar($varName)/*# : array */
    {
        $class  = get_called_class();
        $parent = get_parent_class($class);

        // merge with ancestors' variable
        $res = $class::${$varName};
        if ($parent) {
            $res = $parent::getStaticVar($varName);
            if ($class::${$varName} != $parent::${$varName}) {
                $res = array_replace_recursive($res, $class::${$varName});
            }
        }
        return $res;
    }
}
