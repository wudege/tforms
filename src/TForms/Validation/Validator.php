<?php

/**
 * @filename Validator.php
 * @touch    13/02/2017 18:28
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Validation;

use TForms\Component;
use TForms\Exception\ValidationException;

abstract class Validator extends Component
{
    /**
     * @var array 内置校验器列表 (name=>class)
     */
    public static $builtInValidators = array(
        'required'  => 'TForms\Validation\RequiredValidator',
        'filter'    => 'FilterValidator',
        'match'     => 'RegularExpressionValidator',
        'email'     => 'EmailValidator',
        'url'       => 'UrlValidator',
        'unique'    => 'UniqueValidator',
        'compare'   => 'CompareValidator',
        'length'    => 'TForms\Validation\StringValidator',
        'in'        => 'RangeValidator',
        'numerical' => 'NumberValidator',
        'captcha'   => 'CaptchaValidator',
        'type'      => 'TypeValidator',
        'file'      => 'FileValidator',
        'default'   => 'DefaultValueValidator',
        'exist'     => 'ExistValidator',
        'boolean'   => 'BooleanValidator',
        'safe'      => 'SafeValidator',
        'unsafe'    => 'UnsafeValidator',
        'date'      => 'DateValidator',
    );

    public $attributes = array();

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
    public static function createValidator($name, $object, $attributes, $params = array())
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
        return $value === NULL || $value === array() || $value === '' || $trim && is_scalar($value) && trim($value) === '';
    }
}