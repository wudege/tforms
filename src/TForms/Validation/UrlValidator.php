<?php
/**
 * @filename UrlValidator.php
 * @touch    15/02/2017 17:31
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Validation;

/**
 * Class UrlValidator
 * @package TForms\Validation
 */
class UrlValidator extends FilterVarValidator
{
    /**
     * filter_var函数支持的所有ID
     * @author wudege <hi@wudege.me>
     * @return mixed
     */
    protected function getFilter()
    {
        return FILTER_VALIDATE_URL;
    }

    /**
     * 错误提示信息
     * @author wudege <hi@wudege.me>
     * @return string
     */
    protected function getMessage()
    {
        return t('TForms', '{attribute} is not a valid URL.');
    }
}
