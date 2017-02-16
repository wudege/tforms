<?php
/**
 * @filename NumberValidator.php
 * @touch    16/02/2017 14:18
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Validation;


use TForms\Exception\ValidationException;

class NumberValidator extends Validator
{
    /**
     * @var boolean 是否只能是整形
     */
    public $integerOnly = false;

    /**
     * @var boolean 是否允许为空，默认为true，即空值被认为是有效值
     */
    public $allowEmpty = true;

    /**
     * @var integer|float 允许的最大值
     */
    public $max;
    /**
     * @var integer|float 允许的最小值
     */
    public $min;
    /**
     * @var string 超过最大值的错误提示
     */
    public $tooBig;
    /**
     * @var string 超过最小值的错误提示
     */
    public $tooSmall;

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
        if ($this->allowEmpty && $this->isEmpty($value)) {
            return;
        }
        if (!is_numeric($value)) {
            $message = $this->message !== NULL ? $this->message : t('TForms', '{attribute} must be a number.');
            $this->addError($object, $attribute, $message);

            return;
        }
        if ($this->integerOnly) {
            if (false === filter_var($value, FILTER_VALIDATE_INT)) {
                $message = $this->message !== NULL ? $this->message : t('TForms', '{attribute} must be an integer.');
                $this->addError($object, $attribute, $message);
            }
        } else {
            if (false === filter_var($value, FILTER_VALIDATE_INT)) {
                $message = $this->message !== NULL ? $this->message : t('TForms', '{attribute} must be a number.');
                $this->addError($object, $attribute, $message);
            }
        }
        if ($this->min !== NULL && $value < $this->min) {
            $message = $this->tooSmall !== NULL ? $this->tooSmall : t('TForms', '{attribute} is too small (minimum is {min}).');
            $this->addError($object, $attribute, $message, array('{min}' => $this->min));
        }
        if ($this->max !== NULL && $value > $this->max) {
            $message = $this->tooBig !== NULL ? $this->tooBig : t('TForms', '{attribute} is too big (maximum is {max}).');
            $this->addError($object, $attribute, $message, array('{max}' => $this->max));
        }
    }
}