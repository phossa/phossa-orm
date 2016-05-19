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

use Phossa\Orm\Model\ModelInterface;

/**
 * Base column
 *
 * @package Phossa\Orm
 * @author  Hong Zhang <phossa@126.com>
 * @see     ColumnInterface
 * @version 1.0.0
 * @since   1.0.0 added
 */
class Column implements ColumnInterface
{
    /**
     * default/common settings for all columns
     *
     * @var    array
     * @access protected
     * @staticvar
     */
    protected static $default_settings = [
        // null or not null, boolean
        'notNull'       => true,

        // raw version of default value
        'defaultRaw'    => null,

        // is primary key, boolean
        'primaryKey'    => false,

        // is unique key, boolean
        'uniqueKey'     => false,

        // autoincrement, boolean
        'autoIncrement' => false,

        // visible in json output, boolean
        'visibility'    => true,

        // column order, int, 0 for default order
        'columnOrder'   => 0,

        // other constraints for this column, string
        'constraint'    => '',

        // callable. e.g. ['beforeSave' => 'serialize']
        'callable'      => [],
    ];

    /**
     * settings to be override by siblings
     *
     * @var    array
     * @access protected
     */
    protected static $column_settings = [];

    /**
     * settings for this instance
     *
     * @var    array
     * @access protected
     */
    protected $settings;

    /**
     * Construct a new column
     *
     * @param  array $settings
     * @param  string $column
     * @access public
     */
    public function __construct(
        array $settings = [],
        /*# string */ $column = ''
    ) {
        // column
        if (!empty($column)) {
            $settings['column'] = $column;
        } else {
            $settings['column'] = static::convertName(
                (new \ReflectionClass(get_called_class()))->getShortName()
            );
        }

        $this->settings = array_replace_recursive(
            self::$default_settings,
            static::getCurrentData('column_settings'),
            $settings
        );
    }

    /**
     * convert name base type either camelCase, snake_type etc.
     *
     * @param  string $name
     * @param  int $converType
     * @param  string $removeSuffix remove suffix if any
     * @return string
     * @access protected
     * @static
     */
    protected static function convertName(
        /*# string */ $name,
        /*# int */ $converType = ModelInterface::NAME_SNAKE,
        /*# string */ $removeSuffix = 'column'
    )/*# : string */ {
        // remove suffix
        if (!empty($removeSuffix) && $removeSuffix ===
            strtolower(substr($name, 0 - strlen($removeSuffix)))
        ) {
            $name = substr($name, 0, - strlen($removeSuffix));
        }

        // convert case
        if ($converType & ModelInterface::NAME_CAMEL) {
            return lcfirst($name);
        } elseif ($converType & ModelInterface::NAME_SNAKE) {
            return ltrim(
                strtolower(preg_replace('/[A-Z]/', '_$0', $name)),
                '_'
            );
        } else {
            return $name;
        }
    }

    /**
     * Merge & replace to get current data
     *
     * @param  string $name
     * @return array
     * @access protected
     */
    protected static function getCurrentData(/*# string */ $name)
    {
        $result = static::${$name};
        if (self::${$name} !== static::${$name}) {
            // explicitly emptied
            if (empty(static::${$name})) {
                $result = [];

            // replace parent's settings
            } else {
                $pclass = get_parent_class(get_called_class());
                $result = array_replace_recursive(
                    $pclass::getCurrentData($name),
                    static::${$name}
                );
            }
        }
        return $result;
    }
}
