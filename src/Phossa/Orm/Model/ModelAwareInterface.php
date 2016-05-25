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

/**
 * ModelAwareInterface
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
interface ModelAwareInterface
{
    /**
     * Set the model
     *
     * @param  ModelInterface $model
     * @return self
     * @access public
     */
    public function setModel(ModelInterface $model);

    /**
     * Get the model
     *
     * @return ModelInterface
     * @access public
     */
    public function getModel()/*# : ModelInterface */;
}
