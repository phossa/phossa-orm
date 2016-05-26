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

namespace Phossa\Orm\Property;

/**
 * Used for serialized settings
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @version 1.0.0
 * @since   1.0.0 added
 */
class SettingsProperty extends PhpArrayProperty
{
    /**
     * {@inheritDoc}
     */
    protected static $default_attributes = [
        // 'settings' can be used as name
        'nameMust'  => false,

        // callable
        'callable'  => [
            'beforeSave' => 'serializeData',
            'afterGet'   => 'unserializeData',
        ],
    ];

    /**
     * Convert any unknown columns, such as 'alias' to settings['alias']
     *
     * @access public
     */
    public function beforeSave()
    {
        // model
        $model = $this->getModel();
        $modelClass = get_class($model);

        // data to serialize
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
     * @access public
     */
    public function afterGet()
    {
        // model
        $model = $this->getModel();

        $settings = unserialize($model->settings);

        unset($model->settings);
        foreach ($settings as $key => $val) {
            $model->$key = $val;
        }
    }
}
