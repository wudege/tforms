<?php
/**
 * @filename EmailValidator.php
 * @touch    15/02/2017 17:14
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Validation;

/**
 * Class EmailValidator
 * @package TForms\Validation
 */
class EmailValidator extends FilterVarValidator
{
    /**
     * filter_var函数支持的所有ID
     * @author wudege <hi@wudege.me>
     * @return mixed
     */
    protected function getFilter()
    {
        return FILTER_VALIDATE_EMAIL;
    }

    /**
     * 错误提示信息
     * @author wudege <hi@wudege.me>
     * @return string
     */
    protected function getMessage()
    {
        return t('TForms', '{attribute} is not a valid email address.');
    }
}
