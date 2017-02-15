<?php
/**
 * @filename StringValidator.php
 * @touch    14/02/2017 14:37
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Validation;


use TForms\Exception\ValidationException;
use TForms\Lang\ZH\TForms;

class StringValidator extends Validator
{

    /**
     * @var integer 字符串最大长度。默认为null，即不限制。
     */
    public $max;
    /**
     * @var integer 字符串最小长度。默认为null,即不限制。
     */
    public $min;
    /**
     * @var string 当字符串过短时使用的错误提示信息。
     */
    public $tooShort;
    /**
     * @var string 当字符串过长时使用的错误提示信息。
     */
    public $tooLong;
    /**
     * @var bool 字符串是否允许为空，默认为true，空字符串被认为是合法字符串
     */
    public $allowEmpty = true;


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
        $attributeLabel = $object->getAttributeLabels($attribute);
        if (is_array($value)) {
            throw new ValidationException(TForms::t('TForms', '{attribute} is invalid.', array('{attribute}' => $attributeLabel)));
        }

        if (function_exists('mb_strlen'))
            $length = mb_strlen($value, 'UTF-8');
        else
            $length = strlen($value);

        if ($this->min !== NULL && $length < $this->min) {
            $message = $this->tooShort !== NULL ? $this->tooShort : TForms::t('TForms', '{attribute} is too short (minimum is {min} characters).',
                array(
                    '{attribute}' => $attributeLabel,
                    '{min}'       => $this->min,
                )
            );
            throw new ValidationException($message);
        }
        if ($this->max !== NULL && $length > $this->max) {
            $message = $this->tooLong !== NULL ? $this->tooLong : TForms::t('TForms', '{attribute} is too long (maximum is {max} characters).',
                array(
                    '{attribute}' => $attributeLabel,
                    '{max}'       => $this->max,
                )
            );
            throw new ValidationException($message);
        }

        return;
    }
}