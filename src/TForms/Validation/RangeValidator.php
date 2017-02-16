<?php
/**
 * @filename RangeValidator.php
 * @touch    15/02/2017 16:34
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Validation;


use TForms\Exception\ValidationException;

class RangeValidator extends Validator
{

    /**
     * @var array 被校验的属性值应当在此数组内
     */
    public $range;
    /**
     * @var boolean 是否使用严格模式，即比较值和类型是否全等
     */
    public $strict = false;
    /**
     * @var boolean 是否允许为空，默认为true，即空值被认为是有效值
     */
    public $allowEmpty = true;
    /**
     * @var boolean 将该校验器逻辑置反，若标记为true，则该校验器将校验属性值不在range数组内
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
        if (!is_array($this->range)) {
            $this->addError($object, $attribute, t('TForms', 'The {attribute} property must be array type.'));
        }
        $result = false;
        if ($this->strict) {
            $result = in_array($value, $this->range, true);
        } else {
            foreach ($this->range as $r) {
                $result = (strcmp($r, $value) === 0);
                if ($result) {
                    break;
                }
            }
        }
        if (!$this->not && !$result) {
            $message = $this->message !== NULL ? $this->message : t('TForms', '{attribute} is not in the list.');
            $this->addError($object, $attribute, $message);
        } elseif ($this->not && $result) {
            $message = $this->message !== NULL ? $this->message : t('TForms', '{attribute} is in the list.');
            $this->addError($object, $attribute, $message);
        }
    }
}