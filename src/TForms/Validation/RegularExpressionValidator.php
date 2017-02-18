<?php
/**
 * @filename RegularExpressionValidator.php
 * @touch    16/02/2017 17:06
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Validation;

use TForms\Exception\ValidationException;

/**
 * Class RegularExpressionValidator
 * @package TForms\Validation
 */
class RegularExpressionValidator extends Validator
{

    /**
     * @var string 正则表达式
     */
    public $pattern;
    /**
     * @var boolean 是否允许为空，默认为true，即空值被认为是有效值
     */
    public $allowEmpty = true;
    /**
     * @var boolean　是否取反
     */
    public $not = false;


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
        if ($this->pattern === null) {
            throw new ValidationException(
                t('TForms', 'The "pattern" property must be specified with a valid regular expression.')
            );
        }
        if (is_array($value) ||
            (!$this->not && !preg_match($this->pattern, $value)) ||
            ($this->not && preg_match($this->pattern, $value))
        ) {
            $message = $this->message !== null ? $this->message : t('TForms', '{attribute} is invalid.');
            $this->addError($object, $attribute, $message);
        }
    }
}
