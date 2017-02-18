<?php
/**
 * @filename Component.php
 * @touch    14/02/2017 14:09
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms;

use TForms\Exception\RuntimeException;
use TForms\Lang\ZH\TForms;

/**
 * Class Component
 * @package TForms
 */
class Component
{

    /**
     *
     * @author wudege <hi@wudege.me>
     *
     * @param $name
     *
     * @return mixed
     * @throws RuntimeException
     */
    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        }
        if (property_exists(get_called_class(), $name)) {
            return $this->$name;
        }
        throw new RuntimeException(TForms::t('TForms', 'Property "{class}.{property}" is not defined.', [
            '{class}'    => get_class($this),
            '{property}' => $name,
        ]));
    }

    /**
     *
     * @author wudege <hi@wudege.me>
     *
     * @param $name
     * @param $value
     *
     * @return bool
     * @throws RuntimeException
     */
    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            return $this->$setter($value);
        }
        if (property_exists(get_called_class(), $name)) {
            $this->$name = $value;

            return true;
        }
        throw new RuntimeException(TForms::t('TForms', 'Property "{class}.{property}" is not defined.', [
            '{class}'    => get_class($this),
            '{property}' => $name,
        ]));
    }
}
