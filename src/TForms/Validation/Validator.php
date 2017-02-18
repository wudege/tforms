<?php

/**
 * @filename Validator.php
 * @touch    13/02/2017 18:28
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Validation;

use TForms\Component;
use TForms\Exception\ValidationException;
use TForms\Form;

/**
 * Class Validator
 * @package TForms\Validation
 */
abstract class Validator extends Component
{
    /**
     * @var array 内置校验器列表 (name=>class)
     */
    public static $builtInValidators = [
        'required'  => 'TForms\Validation\RequiredValidator',
        'length'    => 'TForms\Validation\StringValidator',
        'in'        => 'TForms\Validation\RangeValidator',
        'email'     => 'TForms\Validation\EmailValidator',
        'url'       => 'TForms\Validation\UrlValidator',
        'numerical' => 'TForms\Validation\NumberValidator',
        'match'     => 'TForms\Validation\RegularExpressionValidator',
    ];

    /**
     * @var array
     */
    public $attributes = [];

    /**
     * @var string 用户自定义的错误提示信息
     */
    public $message;

    /**
     *  对指定属性执行当前校验方法
     * @author wudege <hi@wudege.me>
     *
     * @param \TForms\Form $object
     * @param string       $attribute
     *
     * @throws ValidationException
     */
    abstract protected function validateAttribute($object, $attribute);


    /**
     *  根据配置参数生成校验器
     * @author wudege <hi@wudege.me>
     *
     * @param       $name
     * @param       $object
     * @param       $attributes
     * @param array $params
     *
     * @return Validator
     */
    public static function createValidator($name, $object, $attributes, $params = [])
    {
        if (is_string($attributes)) {
            $attributes = preg_split('/[\s,]+/', $attributes, -1, PREG_SPLIT_NO_EMPTY);
        }
        if (method_exists($object, $name)) {
            $validator             = new InlineValidator();
            $validator->attributes = $attributes;
            $validator->method     = $name;
            $validator->params     = $params;
        } else {
            $params['attributes'] = $attributes;
            if (isset(self::$builtInValidators[$name])) {
                $className = self::$builtInValidators[$name];
            } else {
                $className = $name;
            }
            $validator = new $className;
            foreach ($params as $name => $value) {
                $validator->$name = $value;
            }
        }

        return $validator;
    }

    /**
     *
     * @author wudege <hi@wudege.me>
     *
     * @param Form   $object
     * @param string $attribute
     * @param string $message
     * @param array  $params
     *
     * @throws ValidationException
     */
    protected function addError($object, $attribute, $message, $params = [])
    {
        $params['{attribute}'] = $object->getAttributeLabel($attribute);
        throw new ValidationException(strtr($message, $params));
    }

    /**
     *  遍历属性列表执行当前校验器
     * @author wudege <hi@wudege.me>
     *
     * @param $object
     *
     * @return bool
     */
    public function validate($object)
    {
        foreach ($this->attributes as $attribute) {
            $this->validateAttribute($object, $attribute);
        }

        return true;
    }

    /**
     *  判断给出的值是否为空
     * @author wudege <hi@wudege.me>
     *
     * @param      $value
     * @param bool $trim 是否先执行trim方法
     *
     * @return bool
     */
    protected function isEmpty($value, $trim = false)
    {
        return $value === null
            || $value === []
            || $value === ''
            || $trim
            && is_scalar($value)
            && trim($value) === '';
    }
}
