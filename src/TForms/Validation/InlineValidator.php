<?php
/**
 * @filename InlineValidator.php
 * @touch    14/02/2017 11:08
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Validation;

/**
 * Class InlineValidator
 * @package TForms\Validation
 */
final class InlineValidator extends Validator
{
    /**
     * @var string 校验方法名称
     */
    public $method;

    /**
     * @var array 校验方法额外参数
     */
    public $params;

    /**
     *  对指定属性执行当前校验方法
     * @author wudege <hi@wudege.me>
     *
     * @param \TForms\Form $object
     * @param string       $attribute
     */
    protected function validateAttribute($object, $attribute)
    {
        $method = $this->method;
        $object->$method($attribute, $this->params);
    }
}
