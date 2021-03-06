<?php
/**
 * @filename RequiredValidator.php
 * @touch    14/02/2017 14:26
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Validation;

use TForms\Exception\ValidationException;

/**
 * Class RequiredValidator
 * @package TForms\Validation
 */
class RequiredValidator extends Validator
{

    /**
     * @var mixed 期望值
     *            若为null，则当前校验器只校验属性值不为空即可；
     *            若指定值，则需要校验的所有属性值必须与该值相等；
     *            默认值为null;
     */
    public $requiredValue;

    /**
     * @var bool 是否使用严格模式（即同时校验值和类型相等）
     */
    public $strict = false;

    /**
     * @var bool 判断是否为空前是否执行trim()函数
     */
    public $trim = true;


    /**
     *  对指定属性执行当前校验方法
     * @author wudege <hi@wudege.me>
     *
     * @param \TForms\Form $object
     * @param string       $attribute
     *
     * @throws ValidationException
     */
    protected function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;
        if ($this->requiredValue !== null) {
            if (!$this->strict && $value != $this->requiredValue || $this->strict && $value !== $this->requiredValue) {
                $message = $this->message !== null ? $this->message :
                    t(
                        'TForms',
                        '{attribute} must be {value}.',
                        ['{value}' => $this->requiredValue]
                    );
                $this->addError($object, $attribute, $message);
            }
        } elseif ($this->isEmpty($value, $this->trim)) {
            $message = $this->message !== null ? $this->message : t('TForms', '{attribute} cannot be blank.');
            $this->addError($object, $attribute, $message);
        }
    }
}
