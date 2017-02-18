<?php
/**
 * @filename FilterVarValidator.php
 * @touch    15/02/2017 17:40
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Validation;

use TForms\Exception\ValidationException;

/**
 * Class FilterVarValidator
 * @package TForms\Validation
 */
abstract class FilterVarValidator extends Validator
{
    /**
     * @var boolean 是否允许为空，默认为true，即空值被认为是有效值
     */
    public $allowEmpty = true;


    /**
     * filter_var函数支持的所有ID
     * @author wudege <hi@wudege.me>
     * @return mixed
     */
    abstract protected function getFilter();

    /**
     * filter_var函数使用的选项
     * @author wudege <hi@wudege.me>
     * @return null
     */
    protected function getOptions()
    {
        return null;
    }

    /**
     * 错误提示信息
     * @author wudege <hi@wudege.me>
     * @return string
     */
    abstract protected function getMessage();


    /**
     * 错误提示信息Message中使用的参数
     * @author wudege <hi@wudege.me>
     * @return array
     */
    public function getMessageParams()
    {
        return [];
    }


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
        $filter = $this->getFilter();
        $value  = $object->$attribute;
        if ($this->allowEmpty && $this->isEmpty($value)) {
            return;
        }
        $options = $this->getOptions();
        $message = $this->getMessage();
        $params  = $this->getMessageParams();
        if ($filter && $message) {
            if (false === filter_var($value, $filter, $options)) {
                $this->addError($object, $attribute, $message, $params);
            }
        }
    }
}
