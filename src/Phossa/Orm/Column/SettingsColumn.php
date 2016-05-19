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

namespace Phossa\Orm\Column;

use Phossa\Orm\Column\Type\TextType;
use Phossa\Orm\Model\ModelAbstract;

/**
 * settings, used to store serialized value
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     TextType
 * @version 1.0.0
 * @since   1.0.0 added
 */
class SettingsColumn extends TextType
{
    /**
     * {@inheritDoc}
     */
    protected static $column_settings = [
        'default'     => 'a:0:{}',  // an empty array
        'columnOrder' => 100,       // normally the last column
        'callable'    => [
            'beforeSave' => 'beforeSave',   // own method
            'afterGet'   => 'afterGet',     // own method
        ],
    ];

    /**
     * Convert any unknown columns, such as 'alias' to settings['alias']
     *
     * @param ModelAbstract $model
     * @access public
     */
    public function beforeSave(ModelAbstract $model)
    {
        $data = $model->toArray();

        // remove explicit colum from $data
        $cols = $model->getColumns();
        foreach ($cols as $col => $def) {
            if (isset($data[$col]) && $col !== 'settings') {
                unset($data[$col]);
            }
        }

        $model->settings = serialize($data);
    }

    /**
     * Convert any settings , such as settings['alias'] to $model->alias
     *
     * @param ModelAbstract $model
     * @access public
     */
    public function afterGet(ModelAbstract $model)
    {
        $settings = unserialize($model->settings);
        unset($model->settings);
        foreach ($settings as $key => $val) {
            $model->$key = $val;
        }
    }
}
